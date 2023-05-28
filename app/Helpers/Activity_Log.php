<?php

namespace App\Helpers;
use App\Models\Activity_logs;

class Activity_Log
{
    public static function SaveLogs($data)
    {
      Activity_logs::create([
        'log_name'    => 'default' ,
        'description' => $data['description'],
        'subject_type'=> $data['subjecttype'], 
        'subject_id'  => $data['subjectID'],
        'causer_type' => 'App\Models\User', 
        'causer_id'   => $data['causerID'], 
        'properties'  => '[]',
        'created_at'  => date('Y-m-d h:i:s'),
        'updated_at'  => date('Y-m-d h:i:s')
      ]);
    }
}
