<?php

namespace App\Controllers;

use App\Models\PaymentLogModel;
use App\Models\PaymentModel;

class Payment extends BaseController
{
    //frontend
    public function finish()
    {
        $orderId = $this->request->getGet('order_id');
        $status  = $this->request->getGet('transaction_status');

        return view('paymentFinishPage', [
            'orderId' => $orderId,
            'status'  => $status
        ]);
    }

    //api
    public function createTransaction()
    {
        $serverKey   = ""; // ganti dengan server key sandbox
        $orderId     = uniqid();
        $grossAmount = (int) preg_replace('/[^0-9]/', '', $this->request->getPost('gross_amount'));
        $phone       = $this->request->getPost('phone');

        $payload = json_encode([
            "transaction_details" => [
                "order_id"     => $orderId,
                "gross_amount" => $grossAmount
            ],
            "customer_details" => [
                "phone" => $phone
            ],
            "credit_card" => [
                "secure" => true
            ],
            "callbacks" => [
                "finish" => base_url('payment/finish?order_id=' . $orderId . '&transaction_status=settlement')
            ]
        ]);

        $options = [
            "http" => [
                "header"  => "Content-Type: application/json\r\n" .
                            "Accept: application/json\r\n" .
                            "Authorization: Basic " . base64_encode($serverKey . ":") . "\r\n",
                "method"  => "POST",
                "content" => $payload
            ]
        ];

        $context  = stream_context_create($options);
        $result   = file_get_contents("https://app.sandbox.midtrans.com/snap/v1/transactions", false, $context);

        $response = json_decode($result, true);

        return $this->response->setJSON($response);
    }



    public function notification()
    {
        $json = $this->request->getJSON(true);

        $orderId = $json['order_id'] ?? null;
        $status  = $json['transaction_status'] ?? null;
        $phone   = $json['customer_details']['phone'] ?? null;

        if ($orderId && $status) {
            $paymentLog = new PaymentLogModel();

            // updateOrInsert manual
            $existing = $paymentLog->find($orderId);

            if ($existing) {
                $paymentLog->update($orderId, [
                    'phone_number' => $phone,
                    'status'       => $status,
                    'updated_at'   => date('Y-m-d H:i:s')
                ]);
            } else {
                $paymentLog->insert([
                    'order_id'     => $orderId,
                    'phone_number' => $phone,
                    'status'       => $status,
                    'updated_at'   => date('Y-m-d H:i:s')
                ]);
            }
        }

        return $this->response->setJSON(['success' => true]);
    }
    
}
