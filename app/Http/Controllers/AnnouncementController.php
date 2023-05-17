<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;
class AnnouncementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $all = Announcement::orderBy('created_at','desc')->get();
        return view('admin.announcement', compact('all'));
    }

    public function store(Request $request)
    {   
        $typeofaction = $request->typeofaction;
        $title = $request->title;
        $content = $request->content;
        if($typeofaction == "add"){

            Announcement::create([
                'title' => $title,
                'content' => '<p>'.$content.'</p>',
                'is_posted'=>1,
                'created_at'=>date('Y-m-d H:i:s'),
                'post_until'=>date('Y-m-d H:i:s', strtotime('+30 days')),
                'created_by'=>Auth::user()->id
            ]);
    
            return redirect()->back()->with('success','Announcement Posted Successfully!');

        }else {
            $id = $request->id;
            Announcement::findorFail($id)->update([
                'title' => $title,
                'content' => '<p>'.$content.'</p>',
            ]);
     
            return redirect()->back()->with('success','Announcement RePosted Successfully!');
        }
        

     
    }

}
