<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applicants;
use App\Models\Applications;
use App\Models\Jobpost;
use Illuminate\Support\Facades\DB;

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

    public function employee_Dashboard(Request $request){
       return view('employee.dashboard');
    }
}
