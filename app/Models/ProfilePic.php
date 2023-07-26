<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilePic extends Model
{
    use HasFactory;

    protected $table = 'profilepicture';
    public $timestamps = false;
    protected $fillable = [
        'emp_id',
        'photo'
    ];
}
