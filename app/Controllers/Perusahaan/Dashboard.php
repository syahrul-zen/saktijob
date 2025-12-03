<?php

namespace App\Controllers\Perusahaan;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        return view('p_perusahaan/dashboard', [
            'title' => 'Dashboard Perusahaan'
        ]);
    }
}

