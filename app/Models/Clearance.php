<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clearance extends Model
{
    use HasFactory;

    protected $table = '_clearance';
    public $timestamps = false;
    protected $fillable = [
        'emp_id',
        'date_effective',
        'note',
        'status'
    ];
}
