<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PDS_workexperience extends Model
{
    use HasFactory;

    protected $table = 'pds_work_xp';
    protected $fillable = [
        'emp_id',
        'date_from',
        'date_to',
        'position',
        'agency_company',
        'monthly_salary',
        'salary_grade',
        'status_appointment',
        'is_gov_service',
        'ext_id'
    ];
}
