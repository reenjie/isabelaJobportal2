<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave_Credit extends Model
{
    use HasFactory;

    protected $table = '_leave_credit';
    protected $fillable = [
        'empID',
        'empname',
        'dept_code',
        'vacay_lv',
        'sick_lv',
        'dt',
        'actv',
        'f_lv'
    ];
}
