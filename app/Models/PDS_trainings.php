<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PDS_trainings extends Model
{
    use HasFactory;

    protected $table = 'pds_trainings';
    protected $fillable = [
        'emp_id',
        'name',
        'date_from',
        'date_to',
        'no_hours',
        'type',
        'sponsor',
        'ext_id'
    ];
}
