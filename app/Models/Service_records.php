<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service_records extends Model
{
    use HasFactory;
    protected $table= '_servicerecord_tbl';

    protected $fillable = [
        'empID',
        'datefrom',
        'dateto',
        'desig',
        'salary',
        'office_name',
        'branch',
        'lv_abs_wopay',
        'sepdate',
        'date_encoded',
        'encoded_by',
        'sepcause',
        'amntrec',
        'status_'
    ];
}
