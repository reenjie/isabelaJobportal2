<?php

namespace App\Http\Controllers;
use App\Models\JobPostings;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{

   public function __construct()
   {
       $this->middleware('auth');
   }
   public function ViewJob(Request $request){
    $jobid = $request->jobid;

    $search = JobPostings::findorFail($jobid);
    return view('apply',compact('search'));

   }

   public function registerpage(Request $request){
      return view('auth.register');
   }

   public function MyProfile(Request $request){
      if(Auth::user()->emp_id){
         $data  = Employee::where('ID',Auth::user()->emp_id)->get();
      }else {
         $data = [];
      }


     
      return view('profile',compact('data'));
   }
}
