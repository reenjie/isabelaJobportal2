<?php

namespace App\Http\Controllers;
use App\Models\Jobpost;
use App\Models\JobPostings;
use App\Models\Employee;
use App\Models\PDS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PDS_child;
use App\Models\PDS_eligibility;
use App\Models\PDS_workexperience;
use App\Models\PDS_trainings;
use App\Models\PDS_references;
use App\Models\PDS_volwork;
use App\Models\Service_records;
use App\Models\Dtr;
use App\Models\Leave_Credit;
use App\Models\GenPayroll;
use App\Models\LeaveApplications;
use App\Models\Compensatory_timeoff;
use App\Models\DTR_corrections;
use App\Models\Monetizations;
use App\Models\OfficialBPass;
use App\Models\Clearance;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')
        ->except(
            ['homepage',
            'ViewJob',
            'registerpage'
            ]);
    }

    public function homepage(Request $request){
       
        $jobpost = DB::select('SELECT id,
         plantilla_no, 
         title AS position,
          description, 
          eligibility, 
          competencies, 
          educational_background,
           trainings, salary, 
           date_posted,
           (CASE WHEN office_id IS NOT NULL AND office_id <> 0 THEN 
           (SELECT Office FROM _office_tbl WHERE ID = office_id) ELSE "No Office" END) AS office 
           FROM job_posts WHERE is_filled = 0');

    
       return view('welcome',compact('jobpost'));
    }

    public function registerpage(Request $request){
        return view('auth.register');
    }

    public function ViewJob(Request $request){
        $jobid = $request->jobid;
        $search = DB::select('SELECT id,
        plantilla_no, 
        title AS position,
         description, 
         eligibility, 
         competencies, 
         educational_background as education_background,
          trainings, salary , monthly_sal,
          date_posted,
          (CASE WHEN office_id IS NOT NULL AND office_id <> 0 THEN 
          (SELECT Office FROM _office_tbl WHERE ID = office_id) ELSE "No Office" END) AS office 
          FROM job_posts WHERE is_filled = 0 and id ='.$jobid);

        //return $search;
       return view('apply' , compact('search'));
    }

  
    public function MyProfile(Request $request)
    {
        if (Auth::user()->emp_id) {
            $data = Employee::where('ID', Auth::user()->emp_id)->get();
        } else {
            $data = [];
        }

        return view('profile', compact('data'));
    }

    public function personal_data(Request $request)
    {

        $pdsdata = PDS::where('emp_id', Auth::user()->emp_id)->get();
        $pdsChild = PDS_child::where('emp_id', Auth::user()->emp_id)->get();
        $pdseligibility = PDS_eligibility::where('emp_id', Auth::user()->emp_id)->get();
        $pdsworkxp = PDS_workexperience::where('emp_id', Auth::user()->emp_id)->get();
        $pdsvolwork = PDS_volwork::where('emp_id', Auth::user()->emp_id)->get();
        $pdstrainings = PDS_trainings::where('emp_id', Auth::user()->emp_id)->get();
        $pdsreferences = PDS_references::where('emp_id', Auth::user()->emp_id)->get();

     
        return view('employee.personal_data', compact('pdsdata', 'pdsChild', 'pdseligibility', 'pdsworkxp', 'pdsvolwork', 'pdstrainings', 'pdsreferences'));
    }
    public function service_records(Request $request)
    {
        $data = Service_records::where('empID', Auth::user()->emp_id)->paginate(10);
        return view('employee.service_records', compact('data'))->with('links', $data);
    }
    public function daily_time_records(Request $request)
    {
        $data = Dtr::where('empID', Auth::user()->emp_id)
            ->orderBy('dat', 'desc')
            ->paginate(10);

        return view('employee.daily_time_records', compact('data'))->with('links', $data);
    }
    public function leave_credits(Request $request)
    {
        $data = Leave_Credit::where('empID', Auth::user()->emp_id)->paginate(10);

        $currentSalary =  DB::select('SELECT * FROM `_emp_payinfo` where employee_ID ='.Auth::user()->emp_id);
        $salary = $currentSalary[0]->monthly_sal;
      
        return view('employee.leave_credits', compact('data', 'salary'))->with('links', $data);
    }
    public function loan_transaction_records(Request $request)
    {
        return view('employee.loan_transaction_records');
    }
    public function payslips(Request $request)
    {
        $data = GenPayroll::where('emp_ID', Auth::user()->emp_id)->orderby('paydate', 'desc')->paginate(3);
        $payheader = DB::select('SELECT * FROM `_pay_header`');
        return view('employee.payslips', compact('data', 'payheader'))->with('links', $data);
    }
    public function overtime_records(Request $request)
    {
        $data = DB::table('_dtr')
            ->select(
                'dt',
                DB::raw("CASE
            WHEN SUM(TIME_TO_SEC(out_am) - TIME_TO_SEC('08:00:00')) >= 0 THEN
                CONCAT(
                    CASE WHEN SUM(TIME_TO_SEC(out_am) - TIME_TO_SEC('08:00:00')) >= 3600 THEN CONCAT(FLOOR((SUM(TIME_TO_SEC(out_am) - TIME_TO_SEC('08:00:00'))) / 3600), ' hours ') ELSE '' END,
                    CASE WHEN SUM(TIME_TO_SEC(out_am) - TIME_TO_SEC('08:00:00')) >= 60 THEN CONCAT(FLOOR(((SUM(TIME_TO_SEC(out_am) - TIME_TO_SEC('08:00:00'))) % 3600) / 60), ' minutes ') ELSE '' END,
                    CASE WHEN SUM(TIME_TO_SEC(out_am) - TIME_TO_SEC('08:00:00')) < 60 THEN CONCAT((SUM(TIME_TO_SEC(out_am) - TIME_TO_SEC('08:00:00'))) % 60, ' seconds') ELSE '' END
                )
            ELSE 'No overtime'
        END AS total_overtime"),
                'empname'
            )
            ->whereNotNull('empname')
            ->where('empname', '<>', '')
            ->where('empid', Auth::user()->emp_id)
            ->groupBy('dt', 'empname')
            ->havingRaw('SUM(TIME_TO_SEC(out_am) - TIME_TO_SEC("08:00:00")) > 0')
            ->orderByDesc('dt')
            ->paginate(20);
        return view('employee.overtime_records', compact('data'))->with('links', $data);;
    }
    public function discipline_records(Request $request)
    {
        return view('employee.discipline_records');
    }
    public function leave_application(Request $request)
    {
        $data = LeaveApplications::where('emp_id', Auth::user()->emp_id)->paginate(10);
        return view('employee.leave_application', compact('data'))->with('links', $data);
    }
    public function compensatory_timeoff(Request $request)
    {
        $data = Compensatory_timeoff::where('emp_id', Auth::user()->emp_id)->paginate(10);
        return view('employee.compensatory_timeoff', compact('data'))->with('links', $data);
    }
    public function dtr_correction(Request $request)
    {
        $data = DTR_corrections::where('emp_id', Auth::user()->emp_id)->paginate(10);
        return view('employee.dtr_correction', compact('data'))->with('links', $data);
    }
    public function monetization(Request $request)
    {
        $data = Monetizations::where('emp_id', Auth::user()->emp_id)->paginate(10);
        $leaveCredits = Leave_Credit::where('empID', Auth::user()->emp_id)->get();
        return view('employee.monetization', compact('data', 'leaveCredits'))->with('links', $data);
    }
    public function official_business_pass(Request $request)
    {
        $data = OfficialBPass::where('emp_id', Auth::user()->emp_id)->paginate(10);
        return view('employee.official_business_pass', compact('data'))->with('links', $data);
    }
    public function clearance(Request $request)
    {
        $data = Clearance::where('emp_id', Auth::user()->emp_id)->paginate(10);
        return view('employee.clearance', compact('data'))->with('links', $data);
    }

    public function leave_benefits(Request $request)
    {
      // $data = Clearance::where('emp_id', Auth::user()->emp_id)->paginate(10);
      $data =[];
        $maxSalary ="";
        $checkHighest_payroll = DB::select('SELECT MAX(monthly_sal) as MaxSalary FROM `_gen_payroll` where emp_ID =' . Auth::user()->emp_id);
        
        
             if($checkHighest_payroll[0]->MaxSalary >=1){
              
           $maxSalary = $checkHighest_payroll[0]->MaxSalary;
        }else {
          
           $currentSalary =  DB::select('SELECT * FROM `_emp_payinfo` where employee_ID ='.Auth::user()->emp_id);
           $maxSalary = $currentSalary[0]->monthly_sal;
          
        }
  
        
     
     

        $D = DB::select('SELECT vacay_lv,sick_lv , concat(vacay_lv + sick_lv) as D  FROM `_leave_credit` where empID =' . Auth::user()->emp_id);
        $constantFactor = 0.0481927;
        $terminalLeaveBenefits = $maxSalary * $D[0]->D * $constantFactor;

     
       return view('employee.leave_benefits', compact('data', 'maxSalary', 'D', 'constantFactor', 'terminalLeaveBenefits'))->with('links', $data);
    }
}
