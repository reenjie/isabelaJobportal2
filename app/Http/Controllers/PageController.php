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
    // public function ViewJob(Request $request){
    //  $jobid = $request->jobid;

    //  $search = JobPostings::findorFail($jobid);
    //  return view('apply',compact('search'));

    // }

    // public function registerpage(Request $request){
    //    return view('auth.register');
    // }

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
        return view('employee.personal_data');
    }
    public function service_records(Request $request)
    {
        return view('employee.service_records');
    }
    public function daily_time_records(Request $request)
    {
        return view('employee.daily_time_records');
    }
    public function leave_credits(Request $request)
    {
        return view('employee.leave_credits');
    }
    public function loan_transaction_records(Request $request)
    {
        return view('employee.loan_transaction_records');
    }
    public function payslips(Request $request)
    {
        return view('employee.payslips');
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
        return view('employee.leave_application');
    }
    public function compensatory_timeoff(Request $request)
    {
        return view('employee.compensatory_timeoff');
    }
    public function dtr_correction(Request $request)
    {
        return view('employee.dtr_correction');
    }
    public function monetization(Request $request)
    {
        return view('employee.monetization');
    }
    public function official_business_pass(Request $request)
    {
        return view('employee.official_business_pass');
    }
    public function clearance(Request $request)
    {
        return view('employee.clearance');
    }
}
