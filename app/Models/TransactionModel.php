<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $db;

     public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function listTrxPeriode()
    {       
        $query = "SELECT REPLACE(TABLE_NAME,'db_trx_','') AS periode 
        FROM information_schema.TABLES WHERE TABLE_NAME LIKE 'db_trx_%'";
        
        $resultQuery = $this->db->query($query);
		if($resultQuery){
			return $resultQuery->getResultArray();
		}
    }
}