<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
    protected $table = 'announcements';
    public $timestamps = false; 
    protected $fillable= [
        'title',
        'content',
        'is_posted',
        'created_at',
        'post_until',
        'created_by'
    ];


}
