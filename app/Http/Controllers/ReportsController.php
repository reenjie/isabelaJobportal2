<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applications;
use App\Models\Jobpost;
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
            
               case '3':
               $allfilled = Jobpost::where('is_filled',1)->get();
               $title = 'Filled Job Postings';
               $header = [
                'Plantilla_No',
                'Title',
                'Monthly_Salary',
                'Date_posted'
                 ];
                 $body = [];
                foreach($allfilled as $row){
                    $body[] = [
                        'Plantilla_No' =>$row->plantilla_no,
                        'Title' => $row->title,
                        'Monthly_Salary' =>$row->monthly_sal,
                        'Date_posted' => $row->date_posted
                    ];
                }
                return view('admin.reports.Generatereports',compact('header','body','title'));
              
               case '4':
                $forinterviews = DB::select('SELECT CONCAT(a.first_name, " ", a.middle_name, " ", a.last_name) AS applicant_Name,
                a.sex,
                a.email,
                a.mobile_no,
                j.title,
                j.plantilla_no,
                COALESCE(app.interview_date, "No Schedule Yet") AS InterviewDate,
                "For Interview" AS status
         FROM applicants a
         JOIN applications app ON app.applicant_id = a.id AND app.status = 2
         JOIN job_posts j on j.id = app.job_post_id
         ORDER BY `applicant_Name` ASC');
                       $title = 'For Interview Applicants';
                $header = [
                    'Plantilla_NO',
                    'Position Applied',
                    'Applicant_Name',
                    'Gender',
                    'Email',
                    'Mobile_No',
                    'Interview_Schedule',
                    'Status'
                     ];
                     $body = [];
                     foreach($forinterviews as $row){
                         $body[] = [
                            'Plantilla_NO' =>$row->plantilla_no,
                            'Position Applied' =>$row->title,
                            'Applicant_Name' => $row->applicant_Name,
                            'Gender' =>$row->sex,
                            'Email' =>$row->email,
                            'Mobile_No' =>$row->mobile_no,
                            'Interview_Schedule' =>date('h:ia F j,Y',strtotime($row->InterviewDate)),
                            'Status' =>$row->status
                         ];
                     }

                     return view('admin.reports.Generatereports',compact('header','body','title'));
           
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
