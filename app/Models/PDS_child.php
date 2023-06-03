<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PDS_child extends Model
{
    use HasFactory;
    protected $table = 'pds_children';

    protected $fillable = [
        'pds_id',
        'emp_id',
        'name',
        'dob',
        'ext_id'
    ];
}
