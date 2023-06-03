<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PDS_volwork extends Model
{
    use HasFactory;

    protected $table = 'pds_volun_work';
    protected $fillable = [
        'emp_id',
        'name',
        'date_from',
        'date_to',
        'no_of_hours',
        'position',
        'ext_id'
    ];
}
