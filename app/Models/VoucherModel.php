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
        $result =$this->select('UPPER(group_voucher) as group_voucher,group_display,harga,kuota,validity,UPPER(nama_voucher) as nama_voucher')
                ->where('kategori','SIMPATI')
                ->groupBy('group_voucher')
                ->orderBy('validity','ASC')
                ->findAll();

        if (!$result) {
            return null;
        }

        return $result;
    }

    public function cardItemSimpati()
    {       
        $result =$this->select('id, UPPER(group_voucher) as group_voucher,group_display,harga,kuota,validity,UPPER(nama_voucher) as nama_voucher')
                ->where('kategori','SIMPATI')
                ->orderBy('validity','ASC')
                ->findAll();

        if (!$result) {
            return null;
        }

        return $result;
    }

    public function listGroupVFByu()
    {       
        $result =$this->select('UPPER(group_voucher) as group_voucher,group_display,harga,kuota,validity,UPPER(nama_voucher) as nama_voucher')
                ->where('kategori','BYU')
                ->groupBy('group_voucher')
                ->orderBy('validity','ASC')
                ->findAll();

        if (!$result) {
            return null;
        }

        return $result;
    }

    public function cardItemByu()
    {       
        $result =$this->select('id, UPPER(group_voucher) as group_voucher,group_display,harga,kuota,validity,UPPER(nama_voucher) as nama_voucher')
                ->where('kategori','BYU')
                ->orderBy('validity','ASC')
                ->findAll();

        if (!$result) {
            return null;
        }

        return $result;
    }

    public function getGroupDisplay($kategori)
    {
        $result = $this->select('group_display')
                ->where([
                    'kategori' => $kategori
                ])
                ->groupBy('group_display')
                ->findAll();

        if (!$result) {
            return null;
        }

        return $result;
    }

    public function cardItem($id = null)
    {       
        $builder = $this->select('id, UPPER(group_voucher) as group_voucher, group_display, harga, kuota, validity, UPPER(nama_voucher) as nama_voucher')
                        ->orderBy('validity', 'ASC');

        if (!empty($id)) {
            $builder->where('id', $id);
        }

        $result = $builder->first();

        if (!$result) {
            return null;
        }

        return $result;
    }
}