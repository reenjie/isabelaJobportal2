<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applications extends Model
{
    use HasFactory;

    protected $table ='applications';
    
    public $timestamps = false; 
    protected $fillable = [
        'applicant_id',
        'job_post_id',
        'status',
        'interview_date',
        'venue',
        'hmpsb_ids',
        'date_created',
        'date_updated'
    ];
}
