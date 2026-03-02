<?php

namespace App\Controllers;

use App\Models\OutletModel;

class Home extends BaseController
{
    protected $session;

    public function __construct()
    {
        $this->session = session();
    } 

    public function index()
    {
        session()->destroy();
        return view('outletNotFoundPage');
    }

    function outlet($slug)
    {
        $new_slug = strtoupper(str_replace('_', ' ', $slug));

        $outletModel = new OutletModel();

        $authOutlet = $outletModel->authOutlet($slug);

        if (!$authOutlet) {
            return view('outletNotFoundPage');
        }

        $this->session->set(
            ['outlet_name' => $new_slug,
            'outlet_slug' => $slug,
            'isVerified' => TRUE]
        );
       
        return redirect()->to('outlet_store');
        //return view('homePage');
    }

    function history($slug)
    {
        $new_slug = strtoupper(str_replace('_', ' ', $slug));

        $outletModel = new OutletModel();

        $authOutlet = $outletModel->authOutlet($slug);

        if (!$authOutlet) {
            return view('outletNotFoundPage');
        }

        
        $this->session->set(
            ['outlet_name' => $new_slug,
            'outlet_slug' => $slug,
            'isVerified' => TRUE]
        );
       
        return redirect()->to('outlet_history');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }

}
