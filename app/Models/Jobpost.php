<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobpost extends Model
{
    use HasFactory;

    protected $table = 'job_posts';
    protected $fillable = [
        'uid',
        'plantilla_no',
        'title',
        'description',
        'eligibility',
        'competencies',
        'educational_background',
        'trainings',
        'salary',
        'office_id',
        'enabled',
        'is_filled',
        'threshold',
        'status',
        'date_posted',
        'expires_in',
        'deleted_at',
        'created_at',
        'updated_at',
        'created_by',
        'monthly_sal',
        'no_slot'
    ];
}
