<?php

namespace App\Controllers;

use App\Models\OutletModel;
use App\Models\TransactionModel;
use App\Models\VoucherModel;

class Outlet extends BaseController
{
    protected $session;
    protected $vfModel;
    protected $trxModel;

    public function __construct()
    {
        $this->session = session();
        $this->vfModel = new VoucherModel();
        $this->trxModel = new TransactionModel();
    } 

    public function index()
    {
    
        $data['listGroupVfSimpati'] = $this->vfModel->listGroupVFSimpati();
        $data['listGroupVfByu'] = $this->vfModel->listGroupVFByu();

        return view('outletStorePage',$data);
    }

    public function getVoucher()
    {

        $group = $this->request->getPost('group');
        $kategori = $this->request->getPost('kategori');

        $voucher = $this->vfModel
                ->select('nama_voucher,harga')
                ->where([
                    'group_voucher' => $group,
                    'kategori' => $kategori
                ])
                ->orderBy('harga','ASC')
                ->findAll();

        return $this->response->setJSON($voucher);

    }

    public function historyTrx()
    {
        $data['listTrxPeriode'] = $this->trxModel->listTrxPeriode();

        return view('outletHistoryPage',$data);
    }

}
