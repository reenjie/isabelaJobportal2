<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficialBPass extends Model
{
    use HasFactory;
    protected $table = 'or_ob_passes';
    public $timestamps = false; 
    protected $fillable = [
        'emp_id',
        'status',
        'date',
        'time_of_departure',
        'time_of_return',
        'purpose',
        'meta',
        'created_at'
    ];
}
