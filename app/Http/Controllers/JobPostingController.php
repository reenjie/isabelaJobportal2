<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Jobpost;
use App\Models\Offices;
class JobPostingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){   
        $offices = Offices::all();
       return view('admin.jobposting',compact('offices'));
    }

    public function store(Request $request){
        $position       = $request->position;
        $postdate       = $request->postdate;
        $plantilla      = $request->plantilla;
        $monthlyrate    = $request->monthlyrate;
        $salarygrade    = $request->salarygrade;
        $office         = $request->office;
        $description    = $request->description;
        $eligibility    = $request->eligibility;
        $trainings      = $request->trainings;
        $competencies   = $request->competencies;
        $education      = $request->education;
        $uniqueID=md5(rand(100,500).date('Y-m-d H:i:s').'jobposting');
        Jobpost::create([
            'uid'                 => $uniqueID ,
            'title'              =>$position,
            'date_posted'           =>$postdate,
            'plantilla_no'          =>$plantilla,
            'monthly_sal'           =>$monthlyrate,
            'salary'                =>$salarygrade,
            'office_id'                =>$office,
            'description'           =>$description,
            'eligibility'           =>$eligibility,
            'trainings'             =>$trainings,
            'competencies'          =>$competencies,
            'educational_background'=>$education,
            'status'                =>0,
            'created_by'            =>0
        ]);

    return redirect()->back()->with('success',"New Job Published successfully!");

    }

    public function publish(Request $request){
        
     
        Jobpost::findorFail($request->id)->update([
            'status'=>$request->publish
        ]);
        return "success";
    }

    public function edit(Request $request){
       
        $id             = $request->id;
        $position       = $request->position;
        $postdate       = $request->postdate;
        $plantilla      = $request->plantilla;
        $monthlyrate    = $request->monthlyrate;
        $salarygrade    = $request->salarygrade;
        $office         = $request->office;
        $description    = $request->description;
        $eligibility    = $request->eligibility;
        $trainings      = $request->trainings;
        $competencies   = $request->competencies;
        $education      = $request->education;
        
        Jobpost::findorFail($id)->update([
            'title'              =>$position,
            'date_posted'           =>$postdate,
            'plantilla_no'          =>$plantilla,
            'monthly_sal'           =>$monthlyrate,
            'salary'                =>$salarygrade,
            'office'                =>$office,
            'description'           =>$description,
            'eligibility'           =>$eligibility,
            'trainings'             =>$trainings,
            'competencies'          =>$competencies,
            'educational_background'  =>$education,
        ]); 

      return redirect()->back()->with('success',"Job Content Updated Successfully!");
    }

    public function Fetch(Request $request){
        $search = $request->search;
        $data = '';
        if($search){
            $data = Jobpost::where('title','like','%'.$search.'%')->orderBy('created_at', 'desc')->get();
        }else {
            $data = Jobpost::orderBy('created_at', 'desc')->get();
        }
        $offices = Offices::all();
     return view('admin.tables.jobpostTable',compact('data','offices'));
    }
}
