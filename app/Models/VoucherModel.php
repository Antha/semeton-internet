<?php

namespace App\Models;

use CodeIgniter\Model;

class VoucherModel extends Model
{
    protected $table = 'db_voucher';

    protected $allowedFields = [
        'kategori','nama_voucher','group_voucher','validity','harga'
    ];

    public function listGroupVFSimpati()
    {       
        $result =$this->select('UPPER(group_voucher) as group_voucher')
                ->where('kategori','SIMPATI')
                ->groupBy('group_voucher')
                ->orderBy('validity','ASC')
                ->findAll();

        if (!$result) {
            return null;
        }

        return $result;
    }

    public function listGroupVFByu()
    {       
        $result =$this->select('UPPER(group_voucher) as group_voucher')
                ->where('kategori','BYU')
                ->groupBy('group_voucher')
                ->orderBy('validity','ASC')
                ->findAll();

        if (!$result) {
            return null;
        }

        return $result;
    }
}