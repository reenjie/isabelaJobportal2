<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity_logs;
use App\Models\User;

class AuditLogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index(){
        $data = Activity_logs::OrderBy('created_at','desc')->paginate(10);
        $user = User::all();
        return view('admin.auditlogs',compact('data','user'))->with('links', $data);;
    }
}
