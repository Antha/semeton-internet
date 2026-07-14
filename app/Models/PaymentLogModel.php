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
        'updated_at'
    ];

    protected $useTimestamps = false; 
}