<?php

namespace App\Controllers;

use App\Models\JobModel;
use App\Models\CompanyProfileModel;
use App\Models\JobApplicationModel;

class Lowongan extends BaseController
{
    public function index(): string
    {
        $jobModel = new JobModel();
        $companyModel = new CompanyProfileModel();

        $jobs = $jobModel->where('status', 'published')->orderBy('created_at', 'DESC')->findAll();

        $userIds = array_unique(array_map(fn($j) => $j['user_id'], $jobs));
        $profiles = [];
        if (! empty($userIds)) {
            $rows = $companyModel->whereIn('user_id', $userIds)->findAll();
            foreach ($rows as $r) {
                $profiles[$r['user_id']] = $r;
            }
        }

        return view('landing/lowongan', [
            'jobs'     => $jobs,
            'profiles' => $profiles,
            'applicationCount' => ((bool)session('logged_in') && session('role')==='user') ? (new JobApplicationModel())->where('applicant_user_id', session('id'))->countAllResults() : 0,
        ]);
    }

    public function detail($id)
    {
        $jobModel = new JobModel();
        $companyModel = new CompanyProfileModel();

        $job = $jobModel->where('status', 'published')->find($id);
        if (! $job) {
            return redirect()->to('/lowongan');
        }

        $company = $companyModel->where('user_id', $job['user_id'])->first();

        return view('landing/lowongan_detail', [
            'job'     => $job,
            'company' => $company,
            'applicationCount' => ((bool)session('logged_in') && session('role')==='user') ? (new JobApplicationModel())->where('applicant_user_id', session('id'))->countAllResults() : 0,
        ]);
    }
}
