<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PDS_eligibility extends Model
{
    use HasFactory;
    protected $table = "pds_eligibility";

    protected $fillable = [
        'emp_id',
        'name',
        'rating',
        'date_of_exam',
        'place_of_exam',
        'license_no',
        'release_date',
        'ext_id'
    ];
}
