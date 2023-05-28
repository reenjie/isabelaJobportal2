<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AssignedRoles;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     /* 
     Roles
     */
    public function index()
    {
        if (Auth::check()) {
           
            $validate = AssignedRoles::where('entity_id',Auth::user()->id)->get();

            if(count($validate)>=1){
            session(['userRole'=>$validate[0]->role_id]);
              if($validate[0]->role_id == 7){
                return redirect()->route('admin.dashboard'); 
              }

              if($validate[0]->role_id == 8){
                return redirect()->route('employee.dashboard'); 
              }
              
              
            }else {
                Auth::logout();
                return redirect()->route('login');
            }
           
        }
        Auth::logout();
        return redirect()->route('login');
    }
}
