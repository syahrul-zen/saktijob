<?php

namespace App\Models;

use CodeIgniter\Model;

class UserProfileModel extends Model
{
    protected $table         = 'user_profiles';
    protected $primaryKey    = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'user_id',
        'full_name',
        'phone',
        'location',
        'address',
        'photo_url',
        'summary',
        'education_json',
        'certifications_json',
        'skills_json',
        'languages_json',
        'gpa',
        'experience',
        'profile_link',
        'cv_url',
    ];
}

