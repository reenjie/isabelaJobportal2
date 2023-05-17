<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offices extends Model
{
    use HasFactory;
    protected $connection = 'second';
    protected $table = '_office_tbl';

    protected $fillable = [
        'Office ',
        'DEPTCODE',
        'office_type',
        'head_name',
        'empid'
    ];
}
