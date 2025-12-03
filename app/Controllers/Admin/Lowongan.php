<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\JobModel;
use App\Models\CompanyProfileModel;

class Lowongan extends BaseController
{
    public function index()
    {
        $jobModel = new JobModel();
        $companyModel = new CompanyProfileModel();

        $jobs = $jobModel->orderBy('created_at', 'DESC')->findAll();

        $userIds = array_unique(array_map(fn($j) => $j['user_id'], $jobs));
        $profiles = [];
        if (! empty($userIds)) {
            $rows = $companyModel->whereIn('user_id', $userIds)->findAll();
            foreach ($rows as $r) {
                $profiles[$r['user_id']] = $r;
            }
        }

        $grouped = [];
        foreach ($jobs as $job) {
            $uid = $job['user_id'];
            if (!isset($grouped[$uid])) {
                $grouped[$uid] = [
                    'profile' => $profiles[$uid] ?? null,
                    'jobs'    => [],
                ];
            }
            $grouped[$uid]['jobs'][] = $job;
        }

        return view('p_admin/lowongan/index', [
            'title'   => 'Data Lowongan Perusahaan',
            'groups'  => $grouped,
        ]);
    }
}

