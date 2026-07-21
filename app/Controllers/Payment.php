<?php

namespace App\Controllers;

use App\Models\PaymentLogModel;
use App\Models\PaymentModel;
use App\Models\VoucherModel;

class Payment extends BaseController
{
    protected $session;
    protected $vfModel;
    protected $paymentLogModel;

    public function __construct()
    {
        $this->session = session();
        $this->vfModel = new VoucherModel();
        $this->paymentLogModel = new PaymentLogModel();
    } 
    
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
        $env = getenv('MIDTRANS_ENV');

        if ($env === 'production') {
            $baseUrl = getenv('MIDTRANS_PRODUCTION_URL');
            $serverKey = getenv('MIDTRANS_PRODUCTION_KEY');
        } else {
            $baseUrl = getenv('MIDTRANS_SANDBOX_URL');
            $serverKey = getenv('MIDTRANS_SANDBOX_KEY');
        }

        try { 
            $orderId     = uniqid();
            $phone       = $this->request->getPost('phone');
            $id_voucher  = $this->request->getPost('id_voucher');
            $cardItem = $this->vfModel->cardItem($id_voucher);

            if (!$phone) {
                return $this->response
                    ->setStatusCode(400)
                    ->setJSON([
                        'success' => false,
                        'message' => "Please fill phone number"
                    ]);
            }

            $this->paymentLogModel->insert([
                "order_id" => $orderId,
                "phone_number" => $phone,
                "id_voucher" => $id_voucher,
                "id_outlet" => $this->session->get("id_outlet")
            ]);

            $payload = json_encode([
                "transaction_details" => [
                    "order_id"     => $orderId,
                    "gross_amount" => $cardItem['harga']
                ],
                "customer_details" => [
                    "phone" => $phone
                ],
                "item_details" => [
                    "name" =>  $cardItem['nama_voucher'],
                    "price" =>  $cardItem['harga'],
                    'quantity' => 1,
                    "id" =>  $id_voucher
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
                    "content" => $payload,
                    "ignore_errors" => true // supaya tetap bisa baca body walau status error
                ]
            ];

            $context  = stream_context_create($options);
            $result   = file_get_contents($baseUrl."/snap/v1/transactions", false, $context);

            if ($result === false) {
                return $this->response
                    ->setStatusCode(500)
                    ->setJSON([
                        'success' => false,
                        'message' => 'Failed to connect to Midtrans API'
                    ]);
            }

            $response = json_decode($result, true);

            // kalau Midtrans balikin error
            if (isset($response['error_messages'])) {
                return $this->response
                    ->setStatusCode(400)
                    ->setJSON([
                        'success' => false,
                        'message' => $response['error_messages']
                    ]);
            }

            return $this->response->setJSON([
                'success' => true,
                'data'    => $response
            ]);

        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'success' => false,
                    'message' => $e->getMessage()
                ]);
        }
    }


    public function notification()
    {
        try {
            $json = $this->request->getJSON(true);
            $env = getenv('MIDTRANS_ENV');

            if ($env === 'production') {
                $serverKey = getenv('MIDTRANS_PRODUCTION_KEY');
            } else {
                $serverKey = getenv('MIDTRANS_SANDBOX_KEY');
            }


            $orderId     = $json['order_id'] ?? null;
            $status      = $json['transaction_status'] ?? null;
            $statusCode  = $json['status_code'] ?? null;
            $phone       = $json['customer_details']['phone'] ?? null;
            $grossAmount = $json['gross_amount'] ?? null;
            $paymentType = $json['payment_type'] ?? null;

            $expectedSignature = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

            if ($json['signature_key'] !== $expectedSignature) {
                return $this->response
                    ->setStatusCode(400)
                    ->setJSON([
                        'success' => false,
                        'error'   => 'Signature mismatch'
                    ]);
            }

            if ($orderId && $status) {
                $paymentLog = new \App\Models\PaymentLogModel();
                $existing   = $paymentLog->find($orderId);

                $data = [
                    'phone_number' => $phone,
                    'status'       => $status,
                    'payment_type' => $paymentType,
                    'gross_amount' => $grossAmount,
                    'updated_at'   => date('Y-m-d H:i:s')
                ];

                if ($existing) {
                    $paymentLog->update($orderId, $data);
                } else {
                    $data['order_id'] = $orderId;
                    $paymentLog->insert($data);
                }
            }

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Payment log saved'
            ]);

        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'success' => false,
                    'error'   => $e->getMessage()
                ]);
        }
    }

}
