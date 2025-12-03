<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session   = session();
    }

    // -------------------------
    // FORM LOGIN
    // -------------------------
    public function login()
    {
        return view('auth/login');
    }

    // -------------------------
    // PROSES LOGIN
    // -------------------------
    public function doLogin()
    {
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->userModel->where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Email tidak ditemukan');
        }

        if (!password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Password salah');
        }

        // Set session
        $this->session->set([
            'id'        => $user['id'],
            'email'     => $user['email'],
            'role'      => $user['role'],
            'logged_in' => true
        ]);

        // Update last active
        $this->userModel->update($user['id'], ['last_active' => date('Y-m-d H:i:s')]);

        // Redirect sesuai role
        if ($user['role'] === 'admin') {
            return redirect()->to('/admin/dashboard');
        }

        if ($user['role'] === 'perusahaan') {
            $profileModel = model('App\\Models\\CompanyProfileModel');
            $profile = $profileModel->where('user_id', $user['id'])->first();

            if (! $profile) {
                return redirect()->to('/perusahaan/profile')
                    ->with('swal', [
                        'icon'  => 'info',
                        'title' => 'Lengkapi Profil Perusahaan',
                        'text'  => 'Lengkapi data perusahaan untuk proses verifikasi admin sebelum memasang lowongan.'
                    ]);
            }

            if (($profile['status'] ?? 'pending') !== 'verified') {
                return redirect()->to('/perusahaan/pending')
                    ->with('swal', [
                        'icon'  => 'info',
                        'title' => 'Menunggu Verifikasi',
                        'text'  => 'Profil perusahaan Anda sedang ditinjau oleh admin.'
                    ]);
            }

            return redirect()->to('/perusahaan/dashboard');
        }

        $redirect = $this->request->getPost('redirect');
        if (!empty($redirect) && substr($redirect, 0, 1) === '/' && strpos($redirect, '://') === false) {
            return redirect()->to($redirect);
        }

        return redirect()->to('/user/beranda');
    }

    // -------------------------
    // FORM REGISTER
    // -------------------------
    public function register()
    {
        return view('auth/register');
    }

    // -------------------------
    // REGISTER CHOICE PAGE
    // -------------------------
    public function registerChoice()
    {
        return view('auth/register_choice');
    }

    // -------------------------
    // PROSES REGISTER
    // -------------------------
    public function doRegister()
    {
        $data = $this->request->getPost();

        $rules = [
            'email'            => 'required|valid_email|is_unique[users.email]',
            'password'         => 'required|min_length[6]',
            'password_confirm' => 'required|matches[password]',
            'role'             => 'required|in_list[user,perusahaan]'
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->userModel->save([
            'email'    => $data['email'],
            'password' => $data['password'], // di-hash oleh model hook
            'role'     => $data['role'], // perusahaan, user
        ]);

        return redirect()->to('/login')->with('message', 'Registrasi berhasil, silakan login');
    }

    // -------------------------
    // LOGOUT
    // -------------------------
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/login');
    }
}
