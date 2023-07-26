<?php

namespace App\Http\Controllers;

use App\Models\Clearance;
use Illuminate\Http\Request;
use App\Models\LeaveApplications;
use App\Models\Compensatory_timeoff;
use App\Models\DTR_corrections;
use App\Models\Monetizations;
use App\Models\OfficialBPass;
use App\Models\ProfilePic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function cancel(Request $request)
    {
        $ID = $request->ID;
        LeaveApplications::find($ID)->update([
            'status' => -1,
            'remark' => 'Cancelled by requestor',
        ]);

        return redirect()
            ->back()
            ->with('success', 'Request Cancelled Successfully!');
    }

    public function save_leave_app(Request $request)
    {
        $fromdate = $request->from;
        $to = $request->to;
        $leavetype = json_decode($request->leavetype);
        $emp_id = Auth::user()->emp_id;
        $startDate = strtotime($fromdate);
        $endDate = strtotime($to);

        $validWeekdays = [];

        while ($startDate <= $endDate) {
            // Check if the current date is a weekday (0 = Sunday, 6 = Saturday)
            if (date('N', $startDate) <= 5) {
                $validWeekdays[] = date('Y-m-d', $startDate);
            }

            // Increment the date by 1 day
            $startDate = strtotime('+1 day', $startDate);
        }

        LeaveApplications::create([
            'emp_id' => $emp_id,
            'leave_type_id' => $leavetype->id,
            'leave_type' => $leavetype->name,
            'status' => 11,
            'leave_start_date' => null,
            'leave_end_date' => null,
            'no_of_days' => count($validWeekdays),
            'dates_covered' => implode(',', $validWeekdays),
            'meta' => null,
            'remark' => null,
            'created_at' => date('Y-m-d h:i:s'),
            'downloaded' => 0,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Request Submitted Successfully!');
    }

    public function viewLeavedates(Request $request)
    {
        $dates = explode(',', $request->datescovered);
        $leavetype = $request->leavetype;
        if (Auth::check()) {
            return view(
                'employee.components.viewDates',
                compact('dates', 'leavetype')
            );
        }
        abort(404);
    }

    public function cancelct(Request $request)
    {
        $ID = $request->ID;

        Compensatory_timeoff::find($ID)->update([
            'status' => -1,
            'remark' => 'Cancelled by requestor',
        ]);
        return redirect()
            ->back()
            ->with('success', 'Request Cancelled Successfully!');
    }

    public function cancelDTR(Request $request)
    {
        $ID = $request->ID;

        DTR_corrections::find($ID)->update([
            'status' => -1,
            'remark' => 'Cancelled by requestor',
        ]);
        return redirect()
            ->back()
            ->with('success', 'Request Cancelled Successfully!');
    }

    public function savenewcompensatorytimeoff(Request $request)
    {
        $date = $request->date;
        $timein = $request->timein;
        $timeout = $request->timeout;
        $addinfo = $request->addinfo;
        $emp_id = Auth::user()->emp_id;
        Compensatory_timeoff::create([
            'emp_id' => $emp_id,
            'date'  => $date,
            'time_in' => $timein,
            'time_out' => $timeout,
            'note'  => $addinfo,
            'status' => 1,
            'remark' => '',
            'meta' => null,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        return redirect()
            ->back()
            ->with('success', 'Request Submitted Successfully!');
    }

    public function savedtrCorrections(Request $request)
    {
        $datedtr = $request->datedtr;
        $note = $request->note;
        $emp_id = Auth::user()->emp_id;
        DTR_corrections::create([
            'emp_id' => $emp_id,
            'date' => $datedtr,
            'note' => $note,
            'status' => 1,
            'remark' => '',
            'meta' => null,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()
            ->back()
            ->with('success', 'Request Submitted Successfully!');
    }

    public function cancelmone(Request $request)
    {
        $ID = $request->ID;

        Monetizations::find($ID)->update([
            'status' => -1,
            'remark' => 'Cancelled by requestor',
        ]);
        return redirect()
            ->back()
            ->with('success', 'Request Cancelled Successfully!');
    }

    public function cancelobpass(Request $request)
    {
        $ID = $request->ID;

        OfficialBPass::find($ID)->update([
            'status' => -1,
            'meta' => 'Cancelled by requestor',
        ]);
        return redirect()
            ->back()
            ->with('success', 'Request Cancelled Successfully!');
    }

    public function savedNewmonetization(Request $request)
    {
        $noofdays = $request->noofdays;
        $addinfo = $request->addinfo;
        $emp_id = Auth::user()->emp_id;
        Monetizations::create([
            'emp_id' => $emp_id,
            'no_of_days' => $noofdays,
            'status' => 1,
            'remark' => '',
            'meta' => null,
            'created_at' => date('Y-m-d H:i:s'),
            'downloaded' => 0
        ]);
        return redirect()
            ->back()
            ->with('success', 'Request Submitted Successfully!');
    }

    public function savenewobpass(Request $request)
    {
        $datebp = $request->datebp;
        $timeofdeparture = $request->timeofdeparture;
        $timeofreturn = $request->timeofreturn;
        $purpose = $request->purpose;
        $emp_id = Auth::user()->emp_id;

        OfficialBPass::create([
            'emp_id' => $emp_id,
            'status' => 1,
            'date' => $datebp,
            'time_of_departure' => $timeofdeparture,
            'time_of_return' => $timeofreturn,
            'purpose' => $purpose,
            'meta' => '',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()
            ->back()
            ->with('success', 'Request Submitted Successfully!');
    }

    public function saveclearance(Request $request)
    {
        $effectiveDate = $request->effectiveDate;
        $note = $request->note;

        Clearance::create([
            'emp_id' => Auth::user()->emp_id,
            'date_effective' => $effectiveDate,
            'note'  => $note,
            'status' => 1
        ]);

        return redirect()
            ->back()
            ->with('success', 'Clearance Submitted Successfully!');
    }
    public function cancelClearance(Request $request)
    {
        $ID = $request->ID;

        Clearance::find($ID)->update([
            'status' => -1,

        ]);
        return redirect()
            ->back()
            ->with('success', 'Request Cancelled Successfully!');
    }

    public function updateProfile(Request $request)
    {
        if ($request->file('file')) {
            if ($request->file('file')->move(public_path('uploads'),  $request->file('file')->getClientOriginalName())) {

                $validate = ProfilePic::where('emp_id', Auth::user()->emp_id);
                if (count($validate->get())) {

                    if (unlink(public_path('uploads') . '/' . $validate->get()[0]->photo)) {
                        $validate->update([
                            'photo' => $request->file('file')->getClientOriginalName()
                        ]);
                    }
                } else {
                    ProfilePic::create([
                        'emp_id' => Auth::user()->emp_id,
                        'photo' => $request->file('file')->getClientOriginalName()
                    ]);
                }

                return redirect()
                    ->back()
                    ->with('success', 'Profile Updated Successfully!');
            }
        }
    }
}
