<?php

namespace App\Http\Controllers;
use App\Models\JobPostings;
use Illuminate\Http\Request;

class PageController extends Controller
{
   public function ViewJob(Request $request){
    $jobid = $request->jobid;

    $search = JobPostings::findorFail($jobid);
    return view('apply',compact('search'));

   }

   public function registerpage(Request $request){
      return view('auth.register');
   }
}
