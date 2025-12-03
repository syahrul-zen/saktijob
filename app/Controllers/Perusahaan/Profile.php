<?php

namespace App\Controllers\Perusahaan;

use App\Controllers\BaseController;
use App\Models\CompanyProfileModel;

class Profile extends BaseController
{
    protected $profileModel;

    public function __construct()
    {
        $this->profileModel = new CompanyProfileModel();
    }

    public function index()
    {
        $userId = session('id');
        $profile = $this->profileModel->where('user_id', $userId)->first();
        return view('p_perusahaan/profile_complete', [
            'title'   => 'Lengkapi Profil Perusahaan',
            'profile' => $profile,
        ]);
    }

    public function submit()
    {
        $userId = session('id');
        $data = $this->request->getPost();

        $rules = [
            'company_name' => 'required|min_length[3]',
            'address'      => 'required|min_length[5]',
            'phone'        => 'required|min_length[6]'
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $payload = [
            'user_id'      => $userId,
            'company_name' => $data['company_name'],
            'address'      => $data['address'] ?? null,
            'phone'        => $data['phone'] ?? null,
            'website'      => $data['website'] ?? null,
            'description'  => $data['description'] ?? null,
            'status'       => 'pending'
        ];

        $existing = $this->profileModel->where('user_id', $userId)->first();
        if ($existing) {
            if (($existing['status'] ?? 'pending') === 'verified') {
                $payload['status'] = 'verified';
            }
            $this->profileModel->update($existing['id'], $payload);
        } else {
            $this->profileModel->insert($payload);
        }

        if (($existing['status'] ?? 'pending') === 'verified') {
            return redirect()->to('/perusahaan/profile')->with('swal', [
                'icon'  => 'success',
                'title' => 'Profil Diperbarui',
                'text'  => 'Perubahan pada profil perusahaan telah disimpan.'
            ]);
        }

        return redirect()->to('/perusahaan/pending')->with('swal', [
            'icon'  => 'success',
            'title' => 'Profil Dikirim',
            'text'  => 'Profil perusahaan Anda telah dikirim dan sedang menunggu verifikasi admin.'
        ]);
    }

    public function pending()
    {
        return view('p_perusahaan/pending_verification', [
            'title' => 'Menunggu Verifikasi'
        ]);
    }
}

