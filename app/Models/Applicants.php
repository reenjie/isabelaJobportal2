<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicants extends Model
{
    use HasFactory;

    protected $table = 'applicants';
    protected $fillable = [
        'uid',
        'first_name',
        'last_name',
        'middle_name',
        'dob',
        'sex',
        'civil_status',
        'email',
        'mobile_no',
        'email_verified',
        'password',
        'last_login',
        'is_lock',
        'date_created',
        'date_updated'
    ];
}
