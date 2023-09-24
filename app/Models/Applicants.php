<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
class Applicants extends Model implements Authenticatable
{
    use HasFactory , AuthenticatableTrait;

    protected $table = 'applicants';
    public $timestamps = false; 
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
        'OTPcode',
        'is_lock',
        'date_created',
        'date_updated'
    ];
}
