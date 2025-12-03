<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\UserProfileModel;

class Profile extends BaseController
{
    public function index()
    {
        $userId = session('id');
        $model = new UserProfileModel();
        $row = $model->where('user_id', $userId)->first();
        $profile = [];
        if ($row) {
            $profile = [
                'full_name'     => $row['full_name'] ?? null,
                'phone'         => $row['phone'] ?? null,
                'location'      => $row['location'] ?? null,
                'address'       => $row['address'] ?? null,
                'photo_url'     => $row['photo_url'] ?? null,
                'summary'       => $row['summary'] ?? null,
                'education'     => $row['education_json'] ? json_decode($row['education_json'], true) : null,
                'certifications'=> $row['certifications_json'] ? json_decode($row['certifications_json'], true) : [],
                'skills'        => $row['skills_json'] ? json_decode($row['skills_json'], true) : [],
                'languages'     => $row['languages_json'] ? json_decode($row['languages_json'], true) : [],
                'gpa'           => $row['gpa'] ?? null,
                'experience'    => $row['experience'] ?? null,
                'profile_link'  => $row['profile_link'] ?? null,
                'cv_url'        => $row['cv_url'] ?? null,
            ];
        } else {
            $profile = session('user_profile') ?? [];
        }
        return view('p_user/profile/show', [
            'title'   => 'Profil Saya',
            'profile' => $profile,
            'email'   => session('email') ?? null,
        ]);
    }

    public function edit()
    {
        return redirect()->to('/user/profile');
    }

    public function submit()
    {
        $data = $this->request->getPost();

        $rules = [];
        if (array_key_exists('full_name', $data)) { $rules['full_name'] = 'required|min_length[3]'; }
        if (array_key_exists('phone', $data))     { $rules['phone']     = 'required|min_length[6]'; }
        if (array_key_exists('location', $data))  { $rules['location']  = 'required|min_length[3]'; }
        if (array_key_exists('address', $data))   { $rules['address']   = 'permit_empty|min_length[3]'; }
        if (array_key_exists('gpa', $data))       { $rules['gpa']       = 'permit_empty'; }
        if (array_key_exists('experience', $data)){ $rules['experience']= 'permit_empty'; }
        if (array_key_exists('profile_link', $data)) { $rules['profile_link'] = 'permit_empty|valid_url'; }

        if (! empty($rules) && ! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $payload = [];
        foreach (['full_name','phone','location','summary','cv_url','address','gpa','experience','profile_link','photo_url'] as $f) {
            if (array_key_exists($f, $data)) {
                $payload[$f] = $data[$f];
            }
        }

        // Education
        if (!empty($data['education_degree']) || !empty($data['education_school']) || !empty($data['education_period']) || !empty($data['education_notes'])) {
            $payload['education'] = [
                'degree' => $data['education_degree'] ?? null,
                'school' => $data['education_school'] ?? null,
                'period' => $data['education_period'] ?? null,
                'notes'  => $data['education_notes'] ?? null,
            ];
        }

        // Certifications (each line: name|issuer|date)
        if (!empty($data['certifications_text'])) {
            $lines = preg_split('/\r?\n/', trim($data['certifications_text']));
            $certs = [];
            foreach ($lines as $line) {
                $line = trim($line);
                if ($line === '') continue;
                $parts = explode('|', $line);
                if (count($parts) >= 3) {
                    $certs[] = [
                        'name'   => trim($parts[0]),
                        'issuer' => trim($parts[1]),
                        'date'   => trim($parts[2]),
                    ];
                } else {
                    $certs[] = $line;
                }
            }
            $payload['certifications'] = $certs;
        }

        // Skills (comma separated)
        if (!empty($data['skills_text'])) {
            $skills = array_filter(array_map('trim', explode(',', $data['skills_text'])));
            $payload['skills'] = $skills;
        }

        // Languages (comma separated)
        if (!empty($data['languages_text'])) {
            $langs = array_filter(array_map('trim', explode(',', $data['languages_text'])));
            $payload['languages'] = array_map(fn($n) => ['name' => $n], $langs);
        }

        $userId = session('id');
        $model = new UserProfileModel();
        $existing = $model->where('user_id', $userId)->first();

        $dbData = ['user_id' => $userId];
        foreach ([
            'full_name','phone','location','address','photo_url','summary','gpa','experience','profile_link','cv_url'
        ] as $f) {
            if (array_key_exists($f, $payload)) {
                $dbData[$f] = $payload[$f];
            }
        }
        if (isset($payload['education']))      { $dbData['education_json']      = json_encode($payload['education']); }
        if (isset($payload['certifications'])) { $dbData['certifications_json'] = json_encode($payload['certifications']); }
        if (isset($payload['skills']))         { $dbData['skills_json']         = json_encode($payload['skills']); }
        if (isset($payload['languages']))      { $dbData['languages_json']      = json_encode($payload['languages']); }

        if ($existing) {
            $model->update($existing['id'], $dbData);
        } else {
            $model->insert($dbData);
        }

        $merged = $existing ? array_merge($existing, $dbData) : $dbData;
        $sessionProfile = [
            'full_name'     => $merged['full_name'] ?? null,
            'phone'         => $merged['phone'] ?? null,
            'location'      => $merged['location'] ?? null,
            'address'       => $merged['address'] ?? null,
            'photo_url'     => $merged['photo_url'] ?? null,
            'summary'       => $merged['summary'] ?? null,
            'education'     => isset($merged['education_json']) ? json_decode($merged['education_json'], true) : (isset($existing['education_json']) ? json_decode($existing['education_json'], true) : null),
            'certifications'=> isset($merged['certifications_json']) ? json_decode($merged['certifications_json'], true) : (isset($existing['certifications_json']) ? json_decode($existing['certifications_json'], true) : []),
            'skills'        => isset($merged['skills_json']) ? json_decode($merged['skills_json'], true) : (isset($existing['skills_json']) ? json_decode($existing['skills_json'], true) : []),
            'languages'     => isset($merged['languages_json']) ? json_decode($merged['languages_json'], true) : (isset($existing['languages_json']) ? json_decode($existing['languages_json'], true) : []),
            'gpa'           => $merged['gpa'] ?? ($existing['gpa'] ?? null),
            'experience'    => $merged['experience'] ?? ($existing['experience'] ?? null),
            'profile_link'  => $merged['profile_link'] ?? ($existing['profile_link'] ?? null),
            'cv_url'        => $merged['cv_url'] ?? ($existing['cv_url'] ?? null),
        ];
        session()->set('user_profile', $sessionProfile);

        return redirect()->to('/user/profile')->with('swal', [
            'icon'  => 'success',
            'title' => 'Profil Disimpan',
            'text'  => 'Data profil telah disimpan.'
        ]);
    }
}
