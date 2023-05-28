<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity_logs extends Model
{
    use HasFactory;

    protected $table = 'activity_log';
    protected $fillable = [
        'log_name' ,
        'description',
        'subject_type', 
        'subject_id',
        'causer_type', 
        'causer_id', 
        'properties',
        'created_at',
        'updated_at'
    ];
}
