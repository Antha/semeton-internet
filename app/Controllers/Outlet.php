<?php

namespace App\Controllers;

use App\Models\OutletModel;
use App\Models\PaymentLogModel;
use App\Models\TransactionModel;
use App\Models\VoucherModel;

class Outlet extends BaseController
{
    protected $session;
    protected $vfModel;
    protected $trxModel;
    protected $paymentLogModel;

    public function __construct()
    {
        $this->session = session();
        $this->vfModel = new VoucherModel();
        $this->trxModel = new TransactionModel();
        $this->paymentLogModel = new PaymentLogModel();
    } 

    public function index()
    {
        $data['listDisplaySimpati'] = $this->vfModel->getGroupDisplay('SIMPATI');
        $data['listGroupVfSimpati'] = $this->vfModel->listGroupVFSimpati();
        $data['cardItemSimpati'] = $this->vfModel->cardItemSimpati();

        $data['listDisplayByu'] = $this->vfModel->getGroupDisplay('BYU');
        $data['listGroupVfByu'] = $this->vfModel->listGroupVFByu();
        $data['cardItemByu'] = $this->vfModel->cardItemByu();

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
        $data['listpaymentlogs'] = $this->paymentLogModel->getByOutlet($this->session->get("id_outlet"));

        return view('outletHistoryPage',$data);
    }
}
