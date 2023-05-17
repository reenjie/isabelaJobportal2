<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Roles;
use App\Models\AssignedRoles;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $employees = Employee::all();
        $roles = Roles::whereNotNull('title')
            ->where('title', '!=', '')
            ->get();
        $RoleSelection = Roles::whereIn('id', [1, 10, 12, 2, 11])->get();

        return view(
            'admin.users',
            compact('employees', 'roles', 'RoleSelection')
        );
    }

    public function Fetch(Request $request)
    {
        $search = $request->search;
        $data = '';
        if ($search) {
            $data = User::whereIn('emp_id', function ($query) use ($search) {
                $query
                    ->select('ID')
                    ->from('_employee')
                    ->where('lastname', 'like', '%' . $search . '%')
                    ->orWhere('firstname', 'like', '%' . $search . '%')
                    ->orWhere('empno', 'like', '%' . $search . '%');
            })
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $data = User::whereNotNull('emp_id')
                ->where('emp_id', '!=', 0)
                ->get();
        }
        $employees = Employee::all();
        $roles = Roles::join(
            'assigned_roles as a',
            'roles.id',
            '=',
            'a.role_id'
        )
            ->select('roles.name', 'a.entity_id', 'roles.id')
            ->get();
        $RoleSelection = Roles::whereIn('id', [1, 10, 12, 2, 11])->get();

        return view(
            'admin.tables.usersTable',
            compact('data', 'employees', 'roles', 'RoleSelection')
        );
    }

    public function store(Request $request)
    {
        $uniqueID = md5(rand(100, 500) . date('Y-m-d H:i:s') . 'users');
        $employeeID = $request->employeeID;
        $empno = $request->empno;
        $email = $request->email;
        $selectedroles = $request->selectedroles;

        $data = Employee::find($employeeID);
        $fullName =
            str_replace(' ', '', $data->lastname) .
            ' ' .
            str_replace(' ', '', $data->firstname);

        $saved = User::create([
            'uid' => $uniqueID,
            'emp_id' => $employeeID,
            'name' => $fullName,
            'first_name' => $data->firstname,
            'last_name' => $data->lastname,
            'middle_name' => $data->midname,
            'email' => $email,
            'username' => 'jpUser_' . $data->lastname,
            'password' => Hash::make('jp_' . $data->lastname),
            'last_login' => date('Y-m-d H:i:s'),
            'email_verified_at' => null,
            'is_locked' => 0,
            'is_active' => 1,
            '_token' => '',
            'remember_token' => null,
        ]);

        foreach ($selectedroles as $roles) {
            AssignedRoles::create([
                'role_id' => $roles,
                'entity_id' => $saved->id,
                'entity_type' => 'App\Models\sampleonly',
                'restricted_to_id' => null,
                'restricted_to_type' => null,
                'scope' => null,
            ]);
        }

        return redirect()
            ->back()
            ->with('success', 'User added successfully!');
    }

    public function update(Request $request)
    {
        $email = $request->email;
        $selectedroles = $request->selectedroles;
        $userID = $request->userID;
        $validate = User::find($userID);
        $roles = AssignedRoles::where('entity_id', $userID)->get();
        $userroles = [];
        $exclude = [8, 4];
        for ($i = 0; $i < count($roles); $i++) {
            $userroles[] = $roles[$i]->role_id;
        }
        if (count($roles) >= 1) {
            if ($selectedroles) {
                $toadd = array_unique(
                    array_merge(
                        array_diff($selectedroles, $userroles),
                        array_diff($userroles, $selectedroles)
                    )
                );

                if (
                    count(array_diff($userroles, $exclude)) >
                    count($selectedroles)
                ) {
                    foreach (array_diff($toadd, $exclude) as $del) {
                        AssignedRoles::where('entity_id', $userID)
                            ->where('role_id', $del)
                            ->delete();
                    }
                    return redirect()
                        ->back()
                        ->with('success', 'Changes Saved Successfully!');
                }

                if (!empty(array_diff($toadd, $exclude))) {
                    foreach (array_diff($toadd, $exclude) as $value) {
                        AssignedRoles::create([
                            'role_id' => $value,
                            'entity_id' => $userID,
                            'entity_type' => 'App\Models\User',
                            'restricted_to_id' => null,
                            'restricted_to_type' => null,
                            'scope' => null,
                        ]);
                    }

                    return redirect()
                        ->back()
                        ->with('success', 'Changes Saved Successfully!');
                } else {
                    return redirect()
                        ->back()
                        ->with('success', 'No changes have been made');
                }
            }

            if (!$selectedroles) {
                $deleted = false;
                foreach (array_diff($userroles, $exclude) as $del) {
                    $validate = AssignedRoles::where(
                        'entity_id',
                        $userID
                    )->where('role_id', $del);
                    $count = $validate->count();
                    if ($count > 0) {
                        $validate->delete();
                        $deleted = true;
                    }
                }
                if ($deleted) {
                    return redirect()
                        ->back()
                        ->with('success', 'Changes Saved Successfully!');
                } else {
                    return redirect()
                        ->back()
                        ->with('success', 'No changes have been made');
                }
            }

            if ($validate->email == $email) {
                return redirect()
                    ->back()
                    ->with('success', 'No changes have been made');
            } else {
                $validate->update([
                    'email' => $email,
                ]);
                return redirect()
                    ->back()
                    ->with('success', 'Changes Saved Successfully!');
            }
        }
    }

    public function lock(Request $request)
    {
        $id = $request->id;
        $lock = $request->lock;

        User::find($id)->update([
            'is_locked' => $lock ? 1 : 0,
        ]);

        return 'success';
    }
}
