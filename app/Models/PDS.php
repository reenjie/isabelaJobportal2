<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PDS extends Model
{
    use HasFactory;

    protected $table = 'pds';
    protected $fillable = [
        'emp_id ',
        'emp_no ',
        'first_name',
        'last_name',
        'middle_name',
        'ext_name',
        'dob',
        'birth_place',
        'sex',
        'civil_status',
        'height',
        'weight',
        'blood_type',
        'gsis_no',
        'pag_ibig_no',
        'philhealth_no',
        'sss_no',
        'tin_no',
        'agency_emp_no',
        'email',
        'mobile_no',
        'tel_no',
        'educ_bg_json',
        'spouse_json',
        'parents_json',
        'res_addcress_json',
        'perm_address_json',
        'skills',
        'recogs',
        'orgs',
        'checks_json'
    ];
}
