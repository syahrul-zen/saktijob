<?php

namespace App\Models;

use CodeIgniter\Model;

class CompanyProfileModel extends Model
{
    protected $table         = 'company_profiles';
    protected $primaryKey    = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'user_id',
        'company_name',
        'address',
        'phone',
        'website',
        'description',
        'status' // pending | verified | rejected
    ];
}

