<?php

namespace App\Controllers;

use App\Models\JobModel;
use App\Models\CompanyProfileModel;
use App\Models\JobApplicationModel;

class Home extends BaseController
{
    public function index(): string
    {
        $jobModel = new JobModel();
        $companyModel = new CompanyProfileModel();

        $jobs = $jobModel->where('status', 'published')->orderBy('created_at', 'DESC')->limit(10)->findAll();
        $total = $jobModel->where('status', 'published')->countAllResults();

        $userIds = array_unique(array_map(fn($j) => $j['user_id'], $jobs));
        $profiles = [];
        if (! empty($userIds)) {
            $rows = $companyModel->whereIn('user_id', $userIds)->findAll();
            foreach ($rows as $r) {
                $profiles[$r['user_id']] = $r;
            }
        }

        return view('landing/home', [
            'jobs'     => $jobs,
            'profiles' => $profiles,
            'hasMore'  => $total > 10,
            'applicationCount' => ((bool)session('logged_in') && session('role')==='user') ? (new JobApplicationModel())->where('applicant_user_id', session('id'))->countAllResults() : 0,
        ]);
    }
}
