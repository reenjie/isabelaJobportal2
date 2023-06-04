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

    ];
}
