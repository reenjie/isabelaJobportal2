<?php

namespace App\Http\Controllers;
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
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
       
        
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
     
        $pdsdata = PDS::where('emp_id',Auth::user()->emp_id)->get();
        $pdsChild = PDS_child::where(   'emp_id',Auth::user()->emp_id)->get();
        $pdseligibility = PDS_eligibility::where('emp_id',Auth::user()->emp_id)->get();
        $pdsworkxp = PDS_workexperience::where('emp_id',Auth::user()->emp_id)->get();
        $pdsvolwork = PDS_volwork::where('emp_id',Auth::user()->emp_id)->get();
        $pdstrainings = PDS_trainings::where('emp_id',Auth::user()->emp_id)->get();
        $pdsreferences = PDS_references::where('emp_id',Auth::user()->emp_id)->get();
        return view('employee.personal_data',compact('pdsdata','pdsChild','pdseligibility','pdsworkxp','pdsvolwork','pdstrainings','pdsreferences'));
    }
    public function service_records(Request $request)
    {
        $data = Service_records::where('empID',Auth::user()->emp_id)->paginate(10);
        return view('employee.service_records',compact('data'))->with('links', $data);
    }
    public function daily_time_records(Request $request)
    {
        $data = Dtr::where('empID', Auth::user()->emp_id)
        ->orderBy('dat','desc')
        ->paginate(10);
    
        return view('employee.daily_time_records',compact('data'))->with('links', $data);
    }
    public function leave_credits(Request $request)
    {   
        $data = Leave_Credit::where('empID',Auth::user()->emp_id)->paginate(10);
        $salary = GenPayroll::where('emp_ID',Auth::user()->emp_id)->get()[0]->monthly_sal;
        return view('employee.leave_credits',compact('data','salary'))->with('links', $data);
    }
    public function loan_transaction_records(Request $request)
    {
        return view('employee.loan_transaction_records');
    }
    public function payslips(Request $request)
    {
        $data = GenPayroll::where('emp_ID',Auth::user()->emp_id)->orderby('paydate','desc')->paginate(3);
        $payheader = DB::select('SELECT * FROM `_pay_header`');
        return view('employee.payslips',compact('data','payheader'))->with('links', $data);
    }
    public function overtime_records(Request $request)
    {
        return view('employee.overtime_records');
    }
    public function discipline_records(Request $request)
    {
        return view('employee.discipline_records');
    }
    public function leave_application(Request $request)
    {   
        $data = LeaveApplications::where('emp_id',Auth::user()->emp_id)->paginate(10);
        return view('employee.leave_application',compact('data'))->with('links', $data);
    }
    public function compensatory_timeoff(Request $request)
    {   
        $data = Compensatory_timeoff::where('emp_id',Auth::user()->emp_id)->paginate(10);
        return view('employee.compensatory_timeoff',compact('data'))->with('links', $data);
    }
    public function dtr_correction(Request $request)
    {
        $data = DTR_corrections::where('emp_id',Auth::user()->emp_id)->paginate(10);
        return view('employee.dtr_correction',compact('data'))->with('links', $data);
    }
    public function monetization(Request $request)
    {
        $data = Monetizations::where('emp_id',Auth::user()->emp_id)->paginate(10);
        $leaveCredits = Leave_Credit::where('empID',Auth::user()->emp_id)->get();
        return view('employee.monetization',compact('data','leaveCredits'))->with('links', $data);
    }
    public function official_business_pass(Request $request)
    {   
        $data = OfficialBPass::where('emp_id',Auth::user()->emp_id)->paginate(10);
        return view('employee.official_business_pass',compact('data'))->with('links', $data);
    }
    public function clearance(Request $request)
    {
        return view('employee.clearance');
    }
}
