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
        $result = $this
            ->select('id_outlet')
            ->where('url_id', $nama_outlet)
            ->first();

        if (!$result) {
            return null;
        }

        return $result;
    }
}