<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Activity_Log;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function index()
    {
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
        $credentials = [
            'email' => $email,
            'password' => $password,
        ];
        if (Auth::attempt($credentials)) {
            session()->forget('countingError');
            session()->forget('timer');
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

            $usersaved = User::create([
                'name' => $fname . ' ' . $lname,
                'email' => $email,
                'role' => 2, // Save as employee
                'password' => Hash::make($password),
            ]);

            $profilesaved = Profile::create([
                'firstname' => $fname,
                'middlename' => $mname,
                'lastname' => $lname,
                'birthdate' => $bdate,
                'sex' => $gender,
                'mobile' => $mobile,
                'fk_userid' => $usersaved->id,
            ]);

            if ($profilesaved) {
                $credentials = [
                    'email' => $email,
                    'password' => $password,
                ];
                if (Auth::attempt($credentials)) {

                    Activity_Log::SaveLogs([
                        'description'=>'First time Logged-in',
                        'subjecttype'=>null,
                        'subjectID' => null,
                        'causerID' =>Auth::user()->id,
                    ]);
                    return redirect()->route('home');
                }
            }
        } catch (\Throwable $th) {
            return back()->withErrors([
                'email' =>
                    'Registration Failed. Email already exist in our database.',
            ]);
        }
    }

    public function logout()
    {   
        Activity_Log::SaveLogs([
            'description'=>'Logged-Out',
            'subjecttype'=>null,
            'subjectID' => null,
            'causerID' =>Auth::user()->id,
        ]);
     
        Auth::logout();
        return redirect()->route('home');
    }
}
