<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applicants;
use App\Models\Applications;
use App\Models\Application_docs;
use App\Models\Jobpost;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\Roles;
use App\Models\AssignedRoles;
use App\Models\User;
class JobApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $AppliedJobpost = Jobpost::whereExists(function($query){
            $query->select(DB::raw(1))
            ->from('applications')
            ->whereRaw('applications.job_post_id =  job_posts.id'); 
        })->orderBy('title', 'asc')
        ->get();

      

       
        return view('admin.jobapplication',compact('AppliedJobpost'));
    }

    public function Fetch(Request $request)
    {

        $hrmpsb = DB::table('_employee')
        ->whereIn('ID', function ($subquery) {
            $subquery->select('emp_id')
                ->from('users')
                ->whereIn('id', function ($innerSubquery) {
                    $innerSubquery->select('entity_id')
                        ->from('assigned_roles')
                        ->where('role_id', '=', 11);
                });
        })
        ->get();
        $search  = $request->search ;
        $applicants = Applicants::whereExists(function ($query) {
            $query->select(DB::raw(1))
                  ->from('applications')
                  ->whereRaw('applications.applicant_id = applicants.id');
        })
        ->orderBy('date_created', 'desc')
        ->get();
        if(isset($request->search) && isset($request->jobpost) && isset($request->filter)){
            /*  all three */
            $applications = Applications::whereExists(function($query){
                $query->select(DB::raw(1))
                      ->from('applicants')
                      ->whereRaw('applicants.id = applications.applicant_id');
            })
            ->whereIn('applicant_id',function($query) use ($search){
                $query->select('id')
                      ->from('applicants')
                      ->where('last_name', 'like', '%' . $search . '%')
                      ->orWhere('first_name', 'like', '%' . $search . '%')
                      ->orWhere('middle_name', 'like', '%' .$search. '%');

            })
            ->where('status',$request->filter)
            ->where('job_post_id',$request->jobpost)
            ->orderBy('date_created', 'asc')
            ->get();


        }else if(isset($request->filter) && isset($request->search)){
            /* filter and search */
             
            $applications = Applications::whereExists(function($query){
                $query->select(DB::raw(1))
                      ->from('applicants')
                      ->whereRaw('applicants.id = applications.applicant_id');
            })
            ->whereIn('applicant_id',function($query) use ($search){
                $query->select('id')
                      ->from('applicants')
                      ->where('last_name', 'like', '%' . $search . '%')
                      ->orWhere('first_name', 'like', '%' . $search . '%')
                      ->orWhere('middle_name', 'like', '%' .$search. '%');

            })
            ->where('status',$request->filter)
            ->orderBy('date_created', 'asc')
            ->get();
        }else if(isset($request->jobpost) && isset($request->search)){
            /* jobpost and search */
            
          
            $applications = Applications::whereExists(function($query){
                $query->select(DB::raw(1))
                      ->from('applicants')
                      ->whereRaw('applicants.id = applications.applicant_id');
            })
            ->whereIn('applicant_id',function($query) use ($search){
                $query->select('id')
                      ->from('applicants')
                      ->where('last_name', 'like', '%' . $search . '%')
                      ->orWhere('first_name', 'like', '%' . $search . '%')
                      ->orWhere('middle_name', 'like', '%' .$search. '%');

            })
            ->where('job_post_id',$request->jobpost)
            ->orderBy('date_created', 'asc')
            ->get();

        }else

        if(isset($request->filter) && isset($request->jobpost)){
            /* filter and jobpost */
          
            $applications = Applications::whereExists(function($query){
                $query->select(DB::raw(1))
                      ->from('applicants')
                      ->whereRaw('applicants.id = applications.applicant_id');
            })
            ->where('status',$request->filter)
            ->where('job_post_id',$request->jobpost)
            ->orderBy('date_created', 'asc')
            ->get();
          

        }else if(isset($request->filter)){
            /* filter only */
          
            $applications = Applications::whereExists(function($query){
                $query->select(DB::raw(1))
                      ->from('applicants')
                      ->whereRaw('applicants.id = applications.applicant_id');
            })
            ->where('status',$request->filter)
            ->orderBy('date_created', 'asc')
            ->get();
           
        }else if(isset($request->jobpost)){
            /* jobpost only */
          
            $applications = Applications::whereExists(function($query){
                $query->select(DB::raw(1))
                      ->from('applicants')
                      ->whereRaw('applicants.id = applications.applicant_id');
            })
            ->where('job_post_id',$request->jobpost)
            ->orderBy('date_created', 'asc')
            ->get();

        }else if (isset($request->search)){
            /* searchonly */
          
            $applications = Applications::whereExists(function($query){
                $query->select(DB::raw(1))
                      ->from('applicants')
                      ->whereRaw('applicants.id = applications.applicant_id');
            })
            ->whereIn('applicant_id',function($query) use ($search){
                $query->select('id')
                      ->from('applicants')
                      ->where('last_name', 'like', '%' . $search . '%')
                      ->orWhere('first_name', 'like', '%' . $search . '%')
                      ->orWhere('middle_name', 'like', '%' .$search. '%');

            })
           
            ->orderBy('date_created', 'asc')
            ->get();
        }
        
        else {
            $applications = Applications::whereExists(function($query){
                $query->select(DB::raw(1))
                      ->from('applicants')
                      ->whereRaw('applicants.id = applications.applicant_id');
            })->orderBy('date_created', 'asc')
            ->get();
        }

        $application_docs = Application_docs::all();
        $jobpost = Jobpost::all();

        return view(
            'admin.tables.applicantsTable',
            compact('applicants', 'applications', 'application_docs', 'jobpost','hrmpsb')
        );
    }


    public function MarkApplicants(Request $request){
       // dd($request);
      $id = $request->id;
      switch ($request->actionType) {
        case 'notqualified':
            Applications::find($id)->update([
                'status'=>0
            ]);
            return "success";
         
      }
      
      
    }

    public function setInterview(Request $request){
        $dateofInterview = $request->dateofInterview;
        $timeofInterview = $request->timeofInterview;
        $venue           = $request->venue;
        $selectedInterviewer = $request->selectedInterviewer;
        $notes           = $request->null;

        echo implode(',',$selectedInterviewer);
    }


}
