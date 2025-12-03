<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CompanyProfileModel;

class Dataperusahaan extends BaseController
{
    protected $profileModel;

    public function __construct()
    {
        $this->profileModel = new CompanyProfileModel();
    }

    public function index()
    {
        $profiles = $this->profileModel->orderBy('status', 'ASC')->orderBy('created_at', 'DESC')->findAll();
        return view('p_admin/dataperusahaan/index', [
            'title'    => 'Data Perusahaan',
            'profiles' => $profiles,
        ]);
    }

    public function verify($id)
    {
        $this->profileModel->update($id, ['status' => 'verified']);
        return redirect()->to('/admin/dataperusahaan')->with('swal', [
            'icon'  => 'success',
            'title' => 'Perusahaan Terverifikasi',
            'text'  => 'Profil perusahaan telah diverifikasi.'
        ]);
    }

    public function reject($id)
    {
        $this->profileModel->update($id, ['status' => 'rejected']);
        return redirect()->to('/admin/dataperusahaan')->with('swal', [
            'icon'  => 'warning',
            'title' => 'Perusahaan Ditolak',
            'text'  => 'Profil perusahaan ditolak.'
        ]);
    }
}

