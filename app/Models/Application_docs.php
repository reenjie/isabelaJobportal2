<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application_docs extends Model
{
    use HasFactory;

    protected $table = 'application_docs';

    protected $fillable = [
        'applicant_id',
        'doc_type_id',
        'file',
        'path',
        'date_created',
        'date_updated'
    ];
}
