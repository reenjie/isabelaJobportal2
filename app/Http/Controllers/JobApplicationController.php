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
use App\Helpers\Activity_Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
class JobApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['appliedJob']);
    }

    public function appliedJob(Request $request){
        $jobid = $request->apply;
        Applications::create([
            'applicant_id' => Auth::guard('applicants')->user()->id,
            'job_post_id'  => $jobid,
            'status'       => 1,
            'interview_date'    => null,
            'venue'         => '',
            'hmpsb_ids'     =>'',
            'date_created' =>now(),
            'date_updated'=>now()
        ]);
        return redirect()->route('landingPage')->with('success','Applied Successfully!');
    }

    public function index(Request $request)
    {
        $AppliedJobpost = DB::select(
            'SELECT * FROM `job_posts` where id in (select job_post_id from applications ) order by title asc  '
        );
        $qrybuilder = Applications::whereExists(function ($query) {
            $query
                ->select(DB::raw(1))
                ->from('applicants')
                ->whereRaw('applicants.id = applications.applicant_id');
        });

        $search = $request->search;
        if (
            isset($request->search) &&
            isset($request->jobpost) &&
            isset($request->status)
        ) {
            /*  all three */
            $applications = $qrybuilder
                ->whereIn('applicant_id', function ($query) use ($search) {
                    $query
                        ->select('id')
                        ->from('applicants')
                        ->where('last_name', 'like', '%' . $search . '%')
                        ->orWhere('first_name', 'like', '%' . $search . '%')
                        ->orWhere('middle_name', 'like', '%' . $search . '%');
                })
                ->where('status', $request->status)
                ->where('job_post_id', $request->jobpost)
                ->orderBy('date_created', 'desc')
                ->paginate(10);
        } elseif (isset($request->status) && isset($request->search)) {
            /* filter and search */

            $applications = $qrybuilder
                ->whereIn('applicant_id', function ($query) use ($search) {
                    $query
                        ->select('id')
                        ->from('applicants')
                        ->where('last_name', 'like', '%' . $search . '%')
                        ->orWhere('first_name', 'like', '%' . $search . '%')
                        ->orWhere('middle_name', 'like', '%' . $search . '%');
                })
                ->where('status', $request->status)
                ->orderBy('date_created', 'desc')
                ->paginate(10);
        } elseif (isset($request->jobpost) && isset($request->search)) {
            /* jobpost and search */

            $applications = $qrybuilder
                ->whereIn('applicant_id', function ($query) use ($search) {
                    $query
                        ->select('id')
                        ->from('applicants')
                        ->where('last_name', 'like', '%' . $search . '%')
                        ->orWhere('first_name', 'like', '%' . $search . '%')
                        ->orWhere('middle_name', 'like', '%' . $search . '%');
                })
                ->where('job_post_id', $request->jobpost)
                ->orderBy('date_created', 'desc')
                ->paginate(10);
        } elseif (isset($request->status) && isset($request->jobpost)) {
            /* filter and jobpost */

            $applications = $qrybuilder
                ->where('status', $request->status)
                ->where('job_post_id', $request->jobpost)
                ->orderBy('date_created', 'desc')
                ->paginate(10);
        } elseif (isset($request->status)) {
            /* filter only */

            $applications = $qrybuilder
                ->where('status', $request->status)
                ->orderBy('date_created', 'desc')

                ->paginate(10);
        } elseif (isset($request->jobpost)) {
            /* jobpost only */

            $applications = $qrybuilder
                ->where('job_post_id', $request->jobpost)
                ->orderBy('date_created', 'desc')
                ->paginate(10);
        } elseif (isset($request->search)) {
            /* searchonly */

            $applications = $qrybuilder
                ->whereIn('applicant_id', function ($query) use ($search) {
                    $query
                        ->select('id')
                        ->from('applicants')
                        ->where('last_name', 'like', '%' . $search . '%')
                        ->orWhere('first_name', 'like', '%' . $search . '%')
                        ->orWhere('middle_name', 'like', '%' . $search . '%');
                })

                ->orderBy('date_created', 'desc')
                ->paginate(10);
        } else {
            $query = DB::table('applications')
                ->whereIn('applicant_id', function ($query) {
                    $query->select('id')->from('applicants');
                })
                ->where('status', 1)
                ->where(
                    'date_created',
                    '>=',
                    DB::raw('CURDATE() - INTERVAL 31 DAY')
                )
                ->orWhere('date_created', '<=', DB::raw('CURDATE()'))
                ->orderBy('date_created', 'desc');

            $applications = $query->paginate(10);
        }

        /* ===================================================== */

        $application_docs = Application_docs::all();
        $jobpost = Jobpost::all();

        $hrmpsb = DB::table('_employee')
            ->whereIn('ID', function ($subquery) {
                $subquery
                    ->select('emp_id')
                    ->from('users')
                    ->whereIn('id', function ($innerSubquery) {
                        $innerSubquery
                            ->select('entity_id')
                            ->from('assigned_roles')
                            ->where('role_id', '=', 11);
                    });
            })
            ->get();
        $applicants = Applicants::whereExists(function ($query) {
            $query
                ->select(DB::raw(1))
                ->from('applications')
                ->whereRaw('applications.applicant_id = applicants.id');
        })
            ->orderBy('date_created', 'desc')
            ->get();
        
            $InterviewSched = DB::table('applicants as a')
            ->select(DB::raw("CONCAT(a.first_name, ' ', a.middle_name, ' ', a.last_name) as Name"), 'app.interview_date')
            ->join('applications as app', 'app.applicant_id', '=', 'a.id')
            ->whereNotNull('app.interview_date')
            ->get();


        return view(
            'admin.jobapplication',
            compact(
                'AppliedJobpost',
                'applications',
                'application_docs',
                'jobpost',
                'hrmpsb',
                'applicants',
                'InterviewSched'

            )
        )->with('links', $applications);
    }

    public function MarkApplicants(Request $request)
    {
        // dd($request);
        $id = $request->id;
        switch ($request->actionType) {
            case 'notqualified':
                Applications::find($id)->update([
                    'status' => 0,
                ]);
                Activity_Log::SaveLogs([
                    'description'=>'Mark as Not qualified',
                    'subjecttype'=>null,
                    'subjectID' => null,
                    'causerID' =>Auth::user()->id,
                ]);
                return 'success';
        }
    }

    public function setInterview(Request $request)
    {
        $dateofInterview = $request->dateofInterview;
        $timeofInterview = $request->timeofInterview;
        $venue = $request->venue;
        $selectedInterviewer = $request->selectedInterviewer;
        $notes = $request->null;
        $appID = $request->appID;
        $applicantfullname = $request->applicantfullname;
        $applicantemail = $request->applicantemail;
        $mobile_no  =$request->mobile_no;
        $jobtitle = $request->jobtitle;

        $interview_date = date(
            'Y-m-d H:i:s',
            strtotime($dateofInterview . ' ' . $timeofInterview)
        );

        Applications::find($appID)->update([
            'status'    =>2,
            'interview_date'=>$interview_date,
            'venue' =>$venue,
            'hmpsb_ids' => implode(',',$selectedInterviewer),
            'date_updated'=>date('Y-m-d h:i:s')
        ]);

        Activity_Log::SaveLogs([
            'description'=>'Set an Interview',
            'subjecttype'=>null,
            'subjectID' => null,
            'causerID' =>Auth::user()->id,
        ]);
        return redirect()->route('mail.sendInterview', [
            'applicantfullname' => $applicantfullname,
            'applicantemail' => $applicantemail,
            'interViewers' => $selectedInterviewer,
            'venue' => $venue,
            'notes' => $notes,
            'interviewDate' => $interview_date,
            'mobile_no'     => $mobile_no,
            'jobtitle'      =>$jobtitle
        ]);
        
    }

    public function SetasHired(Request $request){
        $data = $request->data;
        $jobID = $data['jobID'];
        $userID = $data['userID'];

         /* marked the jobpost filled */
        Jobpost::find($jobID)->update([
            'is_filled'=>1,
        ]);

        /* mark other applicants not qualified */
        Applications::where('applicant_id', '!=', $userID)
        ->where('job_post_id', $jobID)
        ->update([
            'status'=>0
        ]);

        Applications::where('applicant_id', $userID)
        ->where('job_post_id', $jobID)
        ->update([
            'status'=>100
        ]);

        Activity_Log::SaveLogs([
            'description'=>'Set applicant Hired',
            'subjecttype'=>null,
            'subjectID' => null,
            'causerID' =>Auth::user()->id,
        ]);
        
       return "success";
    }
}
