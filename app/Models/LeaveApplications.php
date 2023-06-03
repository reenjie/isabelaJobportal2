<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveApplications extends Model
{
    use HasFactory;

    protected $table = 'or_leave_applications';
    public $timestamps = false; 
    protected $fillable = [
        'emp_id',
        'leave_type_id',
        'leave_type',
        'status',
        'leave_start_date',
        'leave_end_date',
        'no_of_days',
        'dates_covered',
        'meta',
        'remark',
        'created_at',
        'downloaded'
    ];
}
