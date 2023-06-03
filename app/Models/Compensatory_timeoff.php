<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compensatory_timeoff extends Model
{
    use HasFactory;
    protected $table = 'or_compensatory_timeoff';

    public $timestamps = false; 
    protected $fillable = [
        'emp_id',
        'date',
        'time_in',
        'time_out',
        'note',
        'status',
        'remark',
        'meta',
        'created_at'
    ];
}
