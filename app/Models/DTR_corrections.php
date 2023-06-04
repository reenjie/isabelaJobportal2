<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DTR_corrections extends Model
{
    use HasFactory;

    protected $table = 'or_dtr_corrections';
    public $timestamps = false; 
    protected $fillable = [
        'emp_id',
        'date',
        'note',
        'status',
        'remark',
        'meta',
        'created_at'
    ];
}
