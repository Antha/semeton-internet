<?php

namespace App\Controllers;

use App\Models\PaymentLogModel;
use App\Models\PaymentModel;
use GuzzleHttp\Client;

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
        $serverKey = "Mid-server-L00YutOlq9pttL5-fDqp0dW6"; // ganti dengan server key sandbox
        $orderId   = uniqid();
        $grossAmount = $this->request->getPost('gross_amount');
        $grossAmount = (int) preg_replace('/[^0-9]/', '', $grossAmount);
        $phone = $this->request->getPost('phone');

        $client = new Client(['http_errors' => false]); // jangan throw exception otomatis

        $response = $client->post('https://app.sandbox.midtrans.com/snap/v1/transactions', [
            'headers' => [
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/json',
                'Authorization' => 'Basic ' . base64_encode($serverKey . ':')
            ],
            'json' => [
                'transaction_details' => [
                    'order_id'     => $orderId,
                    'gross_amount' => $grossAmount
                ],
                'credit_card' => [
                    'secure' => true
                ],
                "customer_details" => [
                    "phone"      => $phone
                ],
                "callbacks" => [
                    "finish" => base_url('payment/finish?order_id=' . $orderId . '&transaction_status=settlement')
                ]
            ]
        ]);

        // Ambil status code & body
        $statusCode = $response->getStatusCode();
        $body       = json_decode($response->getBody(), true);

        if ($statusCode !== 201) {
            // Kalau error, tampilkan pesan dari Midtrans
            return $this->response->setJSON([
                'error'   => true,
                'status'  => $statusCode,
                'message' => $body['error_messages'] ?? 'Unknown error'
            ]);
        }

        return $this->response->setJSON($body);
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
