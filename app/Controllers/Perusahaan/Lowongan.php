<?php

namespace App\Controllers\Perusahaan;

use App\Controllers\BaseController;
use App\Models\JobModel;

class Lowongan extends BaseController
{
    protected $jobModel;

    public function __construct()
    {
        $this->jobModel = new JobModel();
    }

    public function index()
    {
        $jobs = $this->jobModel->where('user_id', session('id'))->orderBy('created_at', 'DESC')->findAll();
        return view('p_perusahaan/lowongan/index', [
            'title' => 'Lowongan Perusahaan',
            'jobs'  => $jobs,
        ]);
    }

    public function create()
    {
        return view('p_perusahaan/lowongan/create', [
            'title' => 'Buat Lowongan'
        ]);
    }

    public function store()
    {
        $data = $this->request->getPost();
        $rules = [
            'title'           => 'required|min_length[5]',
            'location'        => 'required|min_length[3]',
            'employment_type' => 'required',
            'salary_min'      => 'permit_empty|integer',
            'salary_max'      => 'permit_empty|integer',
            'description'     => 'required|min_length[10]'
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $imagePath = null;
        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && ! $file->hasMoved()) {
            $mime = $file->getMimeType();
            if (! in_array($mime, ['image/jpeg','image/png','image/webp'])) {
                return redirect()->back()->withInput()->with('errors', ['image' => 'Format gambar harus JPG/PNG/WEBP']);
            }
            $targetDir = FCPATH . 'uploads/jobs';
            if (! is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            $newName = $file->getRandomName();
            $file->move($targetDir, $newName);
            $imagePath = 'uploads/jobs/' . $newName;
        }

        $payload = [
            'user_id'         => session('id'),
            'title'           => $data['title'],
            'location'        => $data['location'],
            'employment_type' => $data['employment_type'],
            'salary_min'      => $data['salary_min'] ?? null,
            'salary_max'      => $data['salary_max'] ?? null,
            'description'     => $data['description'],
            'status'          => 'draft',
            'image'           => $imagePath
        ];
        $this->jobModel->insert($payload);
        return redirect()->to('/perusahaan/lowongan')->with('swal', [
            'icon'  => 'success',
            'title' => 'Lowongan Dibuat',
            'text'  => 'Lowongan berhasil dibuat dalam status draft.'
        ]);
    }

    public function edit($id)
    {
        $job = $this->jobModel->where('id', $id)->where('user_id', session('id'))->first();
        if (! $job) {
            return redirect()->to('/perusahaan/lowongan')->with('swal', [
                'icon'  => 'error',
                'title' => 'Tidak ditemukan',
                'text'  => 'Lowongan tidak ditemukan.'
            ]);
        }
        return view('p_perusahaan/lowongan/edit', [
            'title' => 'Ubah Lowongan',
            'job'   => $job,
        ]);
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        $rules = [
            'title'           => 'required|min_length[5]',
            'location'        => 'required|min_length[3]',
            'employment_type' => 'required',
            'salary_min'      => 'permit_empty|integer',
            'salary_max'      => 'permit_empty|integer',
            'description'     => 'required|min_length[10]'
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $payload = [
            'title'           => $data['title'],
            'location'        => $data['location'],
            'employment_type' => $data['employment_type'],
            'salary_min'      => $data['salary_min'] ?? null,
            'salary_max'      => $data['salary_max'] ?? null,
            'description'     => $data['description'],
        ];

        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && ! $file->hasMoved()) {
            $mime = $file->getMimeType();
            if (! in_array($mime, ['image/jpeg','image/png','image/webp'])) {
                return redirect()->back()->withInput()->with('errors', ['image' => 'Format gambar harus JPG/PNG/WEBP']);
            }
            $targetDir = FCPATH . 'uploads/jobs';
            if (! is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            $newName = $file->getRandomName();
            $file->move($targetDir, $newName);
            $imagePath = 'uploads/jobs/' . $newName;

            $existing = $this->jobModel->where('id', $id)->where('user_id', session('id'))->first();
            if ($existing && ! empty($existing['image'])) {
                $oldPath = FCPATH . $existing['image'];
                if (is_file($oldPath)) {
                    @unlink($oldPath);
                }
            }
            $payload['image'] = $imagePath;
        }

        $this->jobModel->where('id', $id)->where('user_id', session('id'))->set($payload)->update();
        return redirect()->to('/perusahaan/lowongan')->with('swal', [
            'icon'  => 'success',
            'title' => 'Lowongan Diperbarui',
            'text'  => 'Perubahan berhasil disimpan.'
        ]);
    }

    public function delete($id)
    {
        $job = $this->jobModel->where('id', $id)->where('user_id', session('id'))->first();
        if ($job && ! empty($job['image'])) {
            $oldPath = FCPATH . $job['image'];
            if (is_file($oldPath)) {
                @unlink($oldPath);
            }
        }
        $this->jobModel->where('id', $id)->where('user_id', session('id'))->delete();
        return redirect()->to('/perusahaan/lowongan')->with('swal', [
            'icon'  => 'success',
            'title' => 'Lowongan Dihapus',
            'text'  => 'Lowongan berhasil dihapus.'
        ]);
    }

    public function publish($id)
    {
        $this->jobModel->where('id', $id)->where('user_id', session('id'))->set(['status' => 'published'])->update();
        return redirect()->to('/perusahaan/lowongan')->with('swal', [
            'icon'  => 'success',
            'title' => 'Lowongan Dipublikasikan',
            'text'  => 'Lowongan kini terlihat oleh pencari kerja.'
        ]);
    }

    public function unpublish($id)
    {
        $this->jobModel->where('id', $id)->where('user_id', session('id'))->set(['status' => 'draft'])->update();
        return redirect()->to('/perusahaan/lowongan')->with('swal', [
            'icon'  => 'info',
            'title' => 'Lowongan Disembunyikan',
            'text'  => 'Lowongan disetel sebagai draft.'
        ]);
    }
}
