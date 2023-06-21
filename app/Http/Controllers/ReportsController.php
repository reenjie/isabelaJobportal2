<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applications;
use Illuminate\Support\Facades\DB;
class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index(){
        return view('admin.reports');
    }

    public function generate(Request $request){
        $selection = $request->selection;
        
        switch ($selection) {
            case '1':
                $pendings = Applications::where('status',1)->get();
                $title = 'Total Count of Pending Applications';
                $header = [
                    'Type',
                    'TotalCounts of Pending'
                ];
                $body = [    
                   [ 'Type'=>'Total Count of Pendings',
                    'TotalCounts of Pending'=>count($pendings)]
                ];
             return view('admin.reports.Generatereports',compact('header','body','title'));
            break;
            case '2':
                $allhired = $results = DB::table('applicants AS a')
                ->select(DB::raw("CONCAT(a.first_name, ' ', a.middle_name, ' ', a.last_name) AS Name"))
                ->selectRaw("GROUP_CONCAT(jp.title SEPARATOR ', ') AS Titles")
                ->leftJoin('applications AS app', 'app.applicant_id', '=', 'a.id')
                ->leftJoin('job_posts AS jp', 'jp.id', '=', 'app.job_post_id')
                ->where('app.status', '=', 100)
                ->groupBy('a.id')
                ->get();
                $title = 'Hired Applicants';
                $header = [
                    'Name',
                    'Job Position'
                ];
                $body = [];
                foreach ($allhired as $hired) {
                    $body[] = [
                        'Name' => $hired->Name,
                        'Job Position' => $hired->Titles,
                    ];
                }
                return view('admin.reports.Generatereports',compact('header','body','title'));
               break;
               case '3':
                echo "filled";
               break;
               case '4':
                echo "for job interview";
               break;
               case '5':
                echo "publish jobpost";
               break;
               case '6':
                echo "filledjob positi";
               break;
               case '7':
                echo "today logs";
               break;
               case '8':
                echo "select logs range";
               break;

           
        }

    }
}
