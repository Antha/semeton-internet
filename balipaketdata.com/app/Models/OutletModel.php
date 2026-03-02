<?php

namespace App\Models;

use CodeIgniter\Model;

class OutletModel extends Model
{
    protected $table = 'db_outlet';
    protected $primaryKey = 'id_outlet';

    protected $allowedFields = [
        'nama_outlet'
    ];

    public function authOutlet($nama_outlet)
    {
        $nama_outlet = strtoupper($nama_outlet);
        
        $result = $this
            ->select('id_outlet')
            ->where('nama_outlet', $nama_outlet)
            ->first();

        if (!$result) {
            return null;
        }

        return $result;
    }
}