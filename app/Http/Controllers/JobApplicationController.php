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
use Illuminate\Support\Facades\Response;
class JobApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
     

        $AppliedJobpost = DB::select('SELECT * FROM `job_posts` where id in (select job_post_id from applications ) order by title asc  ');
         $qrybuilder = Applications::whereExists(function($query){
            $query->select(DB::raw(1))
                  ->from('applicants')
                  ->whereRaw('applicants.id = applications.applicant_id');
        });
        // $applications = [];
        //  if(isset($request->status) && isset($request->jobpost)){
        //     /* filter and jobpost */
          
          
        //     $applications=  $qrybuilder->where('status',$request->status)
        //     ->where('job_post_id',$request->jobpost)
        //     ->orderBy('date_created', 'asc')
        //     ->get();
          

        // }else if(isset($request->status)){
        //     /* filter only */
          
        //     $applications =  $qrybuilder
        //     ->where('status',$request->status)
        //     ->orderBy('date_created', 'asc')
         
        //     ->paginate(10);
           
        // }else if(isset($request->jobpost)){
        //     /* jobpost only */
          
        //     $qrybuilder
        //     ->where('job_post_id',$request->jobpost)
        //     ->orderBy('date_created', 'asc')
        //     ->get();

        // }else {

        //     $query = DB::table('applications')
        //     ->whereIn('applicant_id', function ($query) {
        //         $query->select('id')
        //             ->from('applicants');
        //     })
        //     ->where('status', 1)
        //     ->where('date_created', '>=', DB::raw('CURDATE() - INTERVAL 31 DAY'))
        //     ->where('date_created', '<=', DB::raw('CURDATE()'))
        //     ->orderBy('date_created', 'asc');
        
        // $applications = $query->paginate(10);

        // }



        /* 
x======================================================
        
        
        
        */

        $search = $request->search;
        if(isset($request->search) && isset($request->jobpost) && isset($request->status)){
            /*  all three */
            $applications =  $qrybuilder
            ->whereIn('applicant_id',function($query) use ($search){
                $query->select('id')
                      ->from('applicants')
                      ->where('last_name', 'like', '%' . $search . '%')
                      ->orWhere('first_name', 'like', '%' . $search . '%')
                      ->orWhere('middle_name', 'like', '%' .$search. '%');

            })
            ->where('status',$request->status)
            ->where('job_post_id',$request->jobpost)
            ->orderBy('date_created', 'asc')
            ->paginate(10);


        }else if(isset($request->status) && isset($request->search)){
            /* filter and search */
             
            $applications =  $qrybuilder
            ->whereIn('applicant_id',function($query) use ($search){
                $query->select('id')
                      ->from('applicants')
                      ->where('last_name', 'like', '%' . $search . '%')
                      ->orWhere('first_name', 'like', '%' . $search . '%')
                      ->orWhere('middle_name', 'like', '%' .$search. '%');

            })
            ->where('status',$request->status)
            ->orderBy('date_created', 'asc')
            ->paginate(10);
        }else if(isset($request->jobpost) && isset($request->search)){
            /* jobpost and search */
            
          
            $applications =  $qrybuilder
            ->whereIn('applicant_id',function($query) use ($search){
                $query->select('id')
                      ->from('applicants')
                      ->where('last_name', 'like', '%' . $search . '%')
                      ->orWhere('first_name', 'like', '%' . $search . '%')
                      ->orWhere('middle_name', 'like', '%' .$search. '%');

            })
            ->where('job_post_id',$request->jobpost)
            ->orderBy('date_created', 'asc')
            ->paginate(10);

        }else

        if(isset($request->status) && isset($request->jobpost)){
            /* filter and jobpost */
          
            $applications =  $qrybuilder
            ->where('status',$request->status)
            ->where('job_post_id',$request->jobpost)
            ->orderBy('date_created', 'asc')
            ->paginate(10);
          

        }else if(isset($request->status)){
            /* filter only */
          
            $applications =  $qrybuilder
            ->where('status',$request->status)
            ->orderBy('date_created', 'asc')
         
            ->paginate(10);
           
        }else if(isset($request->jobpost)){
            /* jobpost only */
          
            $applications =  $qrybuilder
            ->where('job_post_id',$request->jobpost)
            ->orderBy('date_created', 'asc')
            ->paginate(10);

        }else if (isset($request->search)){
            /* searchonly */
          
            $applications =  $qrybuilder
            ->whereIn('applicant_id',function($query) use ($search){
                $query->select('id')
                      ->from('applicants')
                      ->where('last_name', 'like', '%' . $search . '%')
                      ->orWhere('first_name', 'like', '%' . $search . '%')
                      ->orWhere('middle_name', 'like', '%' .$search. '%');

            })
           
            ->orderBy('date_created', 'asc')
            ->paginate(10);
        }
        
        else {
            $query = DB::table('applications')
            ->whereIn('applicant_id', function ($query) {
                $query->select('id')
                    ->from('applicants');
            })
            ->where('status', 1)
            ->where('date_created', '>=', DB::raw('CURDATE() - INTERVAL 31 DAY'))
            ->where('date_created', '<=', DB::raw('CURDATE()'))
            ->orderBy('date_created', 'asc');
        
        $applications = $query->paginate(10);
        }




        /* ===================================================== */



        $application_docs = Application_docs::all();
        $jobpost = Jobpost::all();

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
        $applicants = Applicants::whereExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('applications')
                        ->whereRaw('applications.applicant_id = applicants.id');
                })
                ->orderBy('date_created', 'desc')
                ->get();

      
      
        return view('admin.jobapplication',compact('AppliedJobpost' , 'applications','application_docs','jobpost','hrmpsb','applicants'))->with('links',$applications);
    }


    public function MarkApplicants(Request $request){
       // dd($request);
      $id = $request->id;
      switch ($request->actionType) {
        case 'notqualified':
            Applications::find($id)->update([
                'status'=>0
            ]);
            return 'success';
         
      }
      
      
    }

    public function setInterview(Request $request){
        $dateofInterview = $request->dateofInterview;
        $timeofInterview = $request->timeofInterview;
        $venue           = $request->venue;
        $selectedInterviewer = $request->selectedInterviewer;
        $notes           = $request->null;
        $appID           = $request->appID;

    
        $interview_date = date('Y-m-d H:i:s',strtotime($dateofInterview.' '.$timeofInterview));
      
        Applications::find($appID)->update([
            'status'    =>2,
            'interview_date'=>$interview_date,
            'venue' =>$venue,
            'hmpsb_ids' => implode(',',$selectedInterviewer),
            'date_updated'=>date('Y-m-d h:i:s')
        ]);

        return redirect()->back()->with('success','Interview Set successfully!');

    }

}
