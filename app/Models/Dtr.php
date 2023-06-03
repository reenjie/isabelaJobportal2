<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dtr extends Model
{
    use HasFactory;
    protected $table = '_dtr';

    protected $fillable = [
        'empid',
        'empname',
        'dt',
        'dat',
        'out_am',
        'in_pm',
        'out_pm',
        'supervisor',
        'hrs_abs',
        'hrs_min',
        'dt1'
    ];
}
