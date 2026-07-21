<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentLogModel extends Model
{
    protected $table = 'db_payment_logs';

    protected $primaryKey = 'order_id';

    protected $allowedFields = [
        'order_id',
        'phone_number',
        'status',
        'payment_type',
        'gross_amount',
        'id_voucher',
        'id_outlet',
        'updated_at'
    ];

    protected $useTimestamps = false; 

    public function getByOutlet($idOutlet)
    {
        $builder = $this->where('id_outlet', $idOutlet);
        
        $result  = $builder->findAll();

        $query = $this->getLastQuery()->getQuery();

        $logFile = WRITEPATH . 'logs/custom-log.txt';

        $logEntry = date('Y-m-d H:i:s') . " --> " . $query . PHP_EOL;

        file_put_contents($logFile, $logEntry, FILE_APPEND);

        return $result;
    }

}