<?php

namespace App\Controllers;

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
    

    // public function createTransaction()
    // {
    //     $serverKey = "TWlkLXNlcnZlci1MMDBZdXRPbHE5cHR0TDUtZkRxcDBkVzY6"; 
    //     $orderId   = uniqid(); 
    //     $grossAmount = $this->request->getPost('gross_amount'); // 
    //     $data = [
    //         "transaction_details" => [
    //             "order_id"     => $orderId,
    //             "gross_amount" => (int)$grossAmount
    //         ],
    //         "credit_card" => [
    //             "secure" => true // tambahkan konfigurasi credit card
    //         ]
    //     ];

    //     $client = service('curlrequest', [
    //         'baseURI' => 'https://app.sandbox.midtrans.com',
    //     ]);

    //     try {
    //         $response = $client->post('/snap/v1/transactions', [
    //             'headers' => [
    //                 'Accept'        => 'application/json',
    //                 'Content-Type'  => 'application/json',
    //                 'Authorization' => 'Basic ' . base64_encode($serverKey . ':')
    //             ],
    //             'json' => $data
    //         ]);

    //         return $this->response->setJSON(json_decode($response->getBody(), true));

    //     } catch (\CodeIgniter\HTTP\Exceptions\HTTPException $e) {
    //         return $this->response->setJSON([
    //             'error'   => true,
    //             'message' => $e->getMessage()
    //         ]);
    //     }
    // }

    
}
