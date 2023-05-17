<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = '_employee';

    protected $fillable = [
        'empno',
        'lastname',
        'firstname',
        'midname',
        'bday',
        'place_birth',
        'sex',
        'civil_status',
        'citizenship',
        'blood_type',
        'height',
        'weight',
        'GSIS_no',
        'pagIBIG_no',
        'philhealth_no',
        'TIN',
        'SSS',
        'res_address',
        'res_zip',
        'res_telno',
        'perm_address',
        'perm_zip',
        'perm_telno',
        'email',
        'cellno',
        'picfile',
        'loc_assign',
        'designation',
        'spouse',
        'spouse_occu',
        'spouse_emp',
        'spouse_contact',
        'father',
        'mother',
        'gsis_BPNo',
        'active',
        'licenseno',
        'Sirbno',
        'qdcno',
        'passexp',
        'cocexp',
        'sirbexp',
        'licensexp',
        'contexp',
        'licenseexp',
        'PASSPORTNO',
        'username',
        'password',
        'isDownload',
    ];
}
