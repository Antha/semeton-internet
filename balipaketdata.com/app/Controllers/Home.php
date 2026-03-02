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
        return view('outletNotFoundPage');
    }

    function outlet($slug)
    {
        $new_slug = strtoupper(str_replace('_', ' ', $slug));

        $outletModel = new OutletModel();

        $authOutlet = $outletModel->authOutlet($new_slug);

        if (!$authOutlet) {
            return view('outletNotFoundPage');
        }

        $this->session->set(
            ['outlet_name' => $new_slug,
            'outlet_slug' => $slug,
            'isVerified' => TRUE]
        );

        return view('homePage');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }

}
