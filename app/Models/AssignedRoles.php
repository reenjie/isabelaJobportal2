<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignedRoles extends Model
{
    use HasFactory;

    protected $table = 'assigned_roles';
    public $timestamps = false; 

    protected $fillable = [
        'role_id',
        'entity_id',
        'entity_type',
        'restricted_to_id',
        'restricted_to_type',
        'scope '
    ];
}
