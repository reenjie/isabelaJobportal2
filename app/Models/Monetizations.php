<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monetizations extends Model
{
    use HasFactory;
    protected $table = 'or_monetizations';

    public $timestamps = false; 

    protected $fillable = [
        'emp_id',
        'no_of_days',
        'status',
        'remark',
        'meta',
        'created_at',
        'downloaded'
    ];
}
