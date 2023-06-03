<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PDS_references extends Model
{
    use HasFactory;

    protected $table = 'pds_references';
    protected $fillable = [
        'emp_id',
        'name',
        'address',
        'contact_no',
        'ext_id'
    ];
}
