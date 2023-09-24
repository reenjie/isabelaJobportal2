<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Activity_Log;
use App\Models\Applicants;
use App\Models\Applications;




class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function index(Request $request)
    {
        session(['apply'=>$request->apply]);
        session()->forget('userRole');
        $json = file_get_contents(resource_path('json/logerrortimer.json'));
        $data = json_decode($json, true);
      
        return view('auth.login', compact('data'));
    }

    public function signin(Request $request)
    { 
       
        $email = $request->email;
        $password = $request->password;
        $json = file_get_contents(resource_path('json/logerrortimer.json'));
        $data = json_decode($json, true);
        $firsterror = $data['FirstOffensecount'] - 1;
        session()->forget('userBlocked');
        $credentials = [
            'email' => $email,
            'password' => $password,
        ];

     
        $verified = Applicants::where('email', $email)->first();
        
        if ($verified && Hash::check($password, $verified->password)) {
          
            if (Auth::guard('applicants')->attempt(['email' => $email, 'password' => $password])) {  

               
                if(session()->has('apply')){
                    $jobid = session()->get('apply');
                    $validate = Applications::where('applicant_id',Auth::guard('applicants')->user()->id)
                    ->where('job_post_id',$jobid)->get();

                    if(count($validate)>=1){
                        return redirect()->route('landingPage')->with('exist','applied already');
                    }
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

                
              
               return redirect()->route('landingPage');
            }
        }

     

        // if(session()->has('apply')){
        //     $verifiedUser = Applicants::where('email', $email)->first();

        //     if ($verifiedUser && Hash::check($password, $verifiedUser->password)) {
               
        //         if (Auth::attempt(['email' => $email, 'password' => $password])) {
                  
                  
        //            session()->forget('apply');
        //            return Auth::user();

        //         }
        //     }

        // }

       
        if (Auth::attempt($credentials)) {
            session()->forget('countingError');
            session()->forget('timer');

            if(Auth::user()->is_locked == 1){
                Activity_Log::SaveLogs([
                    'description'=>'Logged-in Attempted | User Blocked',
                    'subjecttype'=>null,
                    'subjectID' => null,
                    'causerID' =>Auth::user()->id,
                ]);
                session(["userBlocked"=>1]);
                Auth::logout();
                return redirect()->route('login');
            }

           Activity_Log::SaveLogs([
                'description'=>'Logged-in',
                'subjecttype'=>null,
                'subjectID' => null,
                'causerID' =>Auth::user()->id,
            ]);


         
           return redirect()->route('home');
        }
        
     
        //Handle Error | Multiple Login Failure
        if (session()->has('countingError')) {
            $count = session()->increment('countingError', $incrementBy = 1);

            if ($count >= $data['FirstOffensecount']) {
                $dateandtime = date('Y-m-d H:i:s');
                session(['timer' => $dateandtime]);

                return redirect()
                    ->back()
                    ->with('disabled', 'disable for multiple error login');
            } else {
                // return redirect("login")->with('error','Invalid Username or Password');
            }
        } else {
            session(['countingError' => 1]);
        }

        if (session()->get('countingError') >= $firsterror) {
            return back()->withErrors([
                'email' =>
                    'If you experience two or more consecutive login failures, the system will prohibit you from logging in for your next attempts.',
            ]);
        } else {
            
           Activity_Log::SaveLogs([
            'description'=>'Logged-in Attempt',
            'subjecttype'=>null,
            'subjectID' => null,
            'causerID' =>0,
        ]);
            return back()->withErrors([
                'email' =>
                    'The Provided Credentials does not match our records',
            ]);
        }

    }

    public function register(Request $request)
    {
        try {
            $fname = $request->fname;
            $mname = $request->mname;
            $lname = $request->lname;
            $bdate = $request->bdate;
            $gender = $request->gender;
            $mobile = $request->mobile;
            $email = $request->email;
            $password = $request->password;


            function generatedOTP() {
                $otpLength = 6;
                $digits = '0123456789';
                $otp = '';
            
                for ($i = 0; $i < $otpLength; $i++) {
                    $otp .= $digits[rand(0, 9)];
                }
                return $otp;
            }

            $otpcode = generatedOTP();

            $validate = Applicants::where('email',$email)->get();

            if(count($validate)>=1){
                return back()->withErrors([
                    'email' =>
                        'Registration Failed. Email already exist in our database.',
                ]);
            }
         
         $uniqueID = md5(rand(100, 500) . date('Y-m-d H:i:s') . 'users');
           $saved =  Applicants::create([
                'uid'           =>$uniqueID,
                'first_name'    =>$fname,
                'last_name'     =>$lname,
                'middle_name'   =>$mname,
                'dob'           =>$bdate,
                'sex'           =>$gender,
                'civil_status'  => '',
                'email'         =>$email,
                'mobile_no'     =>$mobile,
                'email_verified'=>null,
                'password'      =>Hash::make($password),
                'OTPcode'       =>$otpcode,
                'is_lock'       =>0,
                'date_created'  =>now(),
                'date_updated' =>now()
            ]);

            session(['otp'=>[
                    'email'=>$email,
                    'otpCode'=>$otpcode,
                    'Username'=> $fname.' '.$lname
            ]]);
            
           if($saved){

            return redirect()->route('mail.sendOTP');

           }

                
            
        } catch (\Throwable $th) {
        
            return back()->withErrors([
                'email' =>
                    'Registration Failed. Email already exist in our database.',
            ]);
        }
    }

    public function validateOTP(Request $request){
        $entered  = $request->data;

        $sess = session()->get('otp');
        $email = $sess['email'];
        $Username = $sess['Username'];
        $otpcode = $sess['otpCode'];
           
        if($entered === $otpcode){
            session()->forget('otpSend');
            session()->forget('otp');
            session(['redirecttoLogin'=>true]);


            return response()->json(['message'=>'success']);
        }

        return response()->json(['message'=>'failed']);
    }

    public function logout()
    {   
        if(Auth::guard('applicants')->check()){
         $userid = Auth::guard('applicants')->user()->id;
        }else {
            $userid=Auth::user()->id;
        }

        Activity_Log::SaveLogs([
            'description'=>'Logged-Out',
            'subjecttype'=>null,
            'subjectID' => null,
            'causerID' =>$userid,
        ]);
        
        if(Auth::guard('applicants')->check()){
            Auth::guard('applicants')->logout();
        }else {
            Auth::logout();
        }

     
        return redirect()->route('home');
    }
}
