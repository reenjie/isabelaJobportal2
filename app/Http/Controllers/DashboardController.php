<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applicants;
use App\Models\Applications;
use App\Models\Jobpost;
use App\Models\Announcement;
use App\Models\LeaveApplications;
use App\Models\Compensatory_timeoff;
use App\Models\DTR_corrections;
use App\Models\Monetizations;
use App\Models\OfficialBPass;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $newApplicants = DB::select('SELECT *
        FROM applications
        WHERE date_created = CURDATE()');
        $applicants = Applicants::all();
        $pending = Applications::where('status', 1)->get();
        $overall = DB::select('select * from applications');
        $filledJobpost = Jobpost::where('is_filled', 1)->get();
        $ages = DB::select('SELECT age
                    FROM (
                        SELECT TIMESTAMPDIFF(YEAR, dob, CURDATE()) AS age
                        FROM applicants
                    ) AS subquery
                    WHERE age != 0');

        $firstSet = array_filter($ages, function ($age) {
            return $age->age >= 18 && $age->age <= 25;
        });

        $secondSet = array_filter($ages, function ($age) {
            return $age->age >= 26 && $age->age <= 30;
        });

        $thirdSet = array_filter($ages, function ($age) {
            return $age->age >= 31 && $age->age <= 40;
        });
        $lastSet = array_filter($ages, function ($age) {
            return $age->age >= 41 && $age->age <= 60;
        });

        return view(
            'admin.dashboard',
            compact(
                'newApplicants',
                'applicants',
                'pending',
                'overall',
                'filledJobpost',
                'ages',
                'firstSet',
                'secondSet',
                'thirdSet',
                'lastSet'
            )
        );
    }

    public function employee_Dashboard(Request $request)
    {
        $announcements = Announcement::all();
        $LeaveApplications = LeaveApplications::where(
            'emp_id',
            Auth::user()->emp_id
        )->get();
        $Compensatory_timeoff = Compensatory_timeoff::where(
            'emp_id',
            Auth::user()->emp_id
        )->get();
        $DTR_corrections = DTR_corrections::where(
            'emp_id',
            Auth::user()->emp_id
        )->get();
        $Monetizations = Monetizations::where(
            'emp_id',
            Auth::user()->emp_id
        )->get();
        $OfficialBPass = OfficialBPass::where(
            'emp_id',
            Auth::user()->emp_id
        )->get();

        $pleave = 0;
        $oleave = 0;
        $aleave = 0;
        $dleave = 0;
        $cleave = 0;

        foreach ($LeaveApplications as $key => $value) {
            if ($value->status == 1 || $value->status == 11) {
                /* pending */
                $pleave++;
            }
            if ($value->status == 12 || $value->status == 13) {
                /* onprogress */
                $oleave++;
            }
            if ($value->status == 2) {
                /* approve */
                $aleave++;
            }
            if ($value->status == 0) {
                /* decline */
                $dleave++;
            }
            if ($value->status == -1) {
                /* cancell */
                $cleave++;
            }
        }
        $pcompensatory = 0;
        $ocompensatory = 0;
        $acompensatory = 0;
        $dcompensatory = 0;
        $ccompensatory = 0;
        foreach ($Compensatory_timeoff as $key => $value) {
            if ($value->status == 1 || $value->status == 11) {
                /* pending */
                $pcompensatory++;
            }
            if ($value->status == 12 || $value->status == 13) {
                /* onprogress */
                $ocompensatory++;
            }
            if ($value->status == 2) {
                /* approve */
                $acompensatory++;
            }
            if ($value->status == 0) {
                /* decline */
                $dcompensatory++;
            }
            if ($value->status == -1) {
                /* cancell */
                $ccompensatory++;
            }
        }

        $pdtrcorrection = 0;
        $odtrcorrection = 0;
        $adtrcorrection = 0;
        $ddtrcorrection = 0;
        $cdtrcorrection = 0;
        foreach ($DTR_corrections as $key => $value) {
            if ($value->status == 1 || $value->status == 11) {
                /* pending */
                $pdtrcorrection++;
            }
            if ($value->status == 12 || $value->status == 13) {
                /* onprogress */
                $odtrcorrection++;
            }
            if ($value->status == 2) {
                /* approve */
                $adtrcorrection++;
            }
            if ($value->status == 0) {
                /* decline */
                $ddtrcorrection++;
            }
            if ($value->status == -1) {
                /* cancell */
                $cdtrcorrection++;
            }
        }

        $pmonetization = 0;
        $omonetization = 0;
        $amonetization = 0;
        $dmonetization = 0;
        $cmonetization = 0;
        foreach ($Monetizations as $key => $value) {
            if ($value->status == 1 || $value->status == 11) {
                /* pending */
                $pmonetization++;
            }
            if ($value->status == 12 || $value->status == 13) {
                /* onprogress */
                $omonetization++;
            }
            if ($value->status == 2) {
                /* approve */
                $amonetization++;
            }
            if ($value->status == 0) {
                /* decline */
                $dmonetization++;
            }
            if ($value->status == -1) {
                /* cancell */
                $cmonetization++;
            }
        }

        $pofficailbpass = 0;
        $oofficailbpass = 0;
        $aofficailbpass = 0;
        $dofficailbpass = 0;
        $cofficailbpass = 0;
        foreach ($OfficialBPass as $key => $value) {
            if ($value->status == 1 || $value->status == 11) {
                /* pending */
                $pofficailbpass++;
            }
            if ($value->status == 12 || $value->status == 13) {
                /* onprogress */
                $oofficailbpass++;
            }
            if ($value->status == 2) {
                /* approve */
                $aofficailbpass++;
            }
            if ($value->status == 0) {
                /* decline */
                $dofficailbpass++;
            }
            if ($value->status == -1) {
                /* cancell */
                $cofficailbpass++;
            }
        }

        $totalPending = $pleave + $pcompensatory + $pdtrcorrection + $pmonetization + $pofficailbpass;
        $totalonProgress = $oleave + $ocompensatory + $odtrcorrection + $omonetization + $oofficailbpass;
        $totalapprove = $aleave + $acompensatory + $adtrcorrection + $amonetization + $aofficailbpass;
        $totaldecline = $dleave + $dcompensatory + $ddtrcorrection + $dmonetization + $dofficailbpass;
        $totalcancel = $cleave + $ccompensatory + $cdtrcorrection + $cmonetization + $cofficailbpass;

       
        return view(
            'employee.dashboard',
            compact(
                'announcements',
                'totalPending',
                'totalonProgress',
                'totalapprove',
                'totaldecline',
                'totalcancel'
            )
        );
    }
}
