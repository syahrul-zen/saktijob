<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\JobModel;
use App\Models\CompanyProfileModel;

class JobsLanding extends BaseController
{
    public function index(): string
    {
        $jobModel = new JobModel();
        $companyModel = new CompanyProfileModel();

        $jobs = $jobModel->where('status', 'published')->orderBy('created_at', 'DESC')->limit(20)->findAll();

        $userIds = array_unique(array_map(fn($j) => $j['user_id'], $jobs));
        $profiles = [];
        if (! empty($userIds)) {
            $rows = $companyModel->whereIn('user_id', $userIds)->findAll();
            foreach ($rows as $r) {
                $profiles[$r['user_id']] = $r;
            }
        }

        return view('landing/home_user', [
            'jobs'      => $jobs,
            'profiles'  => $profiles,
            'savedJobs' => session('saved_jobs') ?? [],
        ]);
    }

    public function save($id)
    {
        if (! (session('logged_in') && session('role') === 'user')) {
            return $this->response->setStatusCode(401)->setJSON(['ok' => false]);
        }
        $jobModel = new JobModel();
        $companyModel = new CompanyProfileModel();
        $job = $jobModel->where('status', 'published')->find($id);
        if (! $job) {
            return $this->response->setStatusCode(404)->setJSON(['ok' => false]);
        }
        $company = $companyModel->where('user_id', $job['user_id'])->first();
        $saved = session('saved_jobs') ?? [];
        $saved[$job['id']] = [
            'id'      => $job['id'],
            'title'   => $job['title'],
            'company' => $company['company_name'] ?? 'Perusahaan',
        ];
        session()->set(['saved_jobs' => $saved]);
        return $this->response->setJSON(['ok' => true, 'saved' => array_values($saved)]);
    }
}
