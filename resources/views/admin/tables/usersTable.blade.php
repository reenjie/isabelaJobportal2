
<table style="font-size:14px" class="table  table-striped" id="users">
    <thead>
        <tr class="" style="text-transform:uppercase;font-weight:normal">
            <th></th>
            <th scope="col">Employee No.</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Assigned Roles</th>
            <th scope="col">Status</th>
            <th scope="col">Last Login</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @if (count($data) >= 1)
            @foreach ($data as $item)
                @foreach ($employees as $user)
                    @if ($user->ID == $item->emp_id)
                        @php
                            $Fullname = $user->lastname . ',' . $user->firstname . ' ' . $user->midname;
                            $Employee_No = $user->empno;
                        
                            
                        @endphp
                    @endif
                @endforeach
                @php
                    $userRoles = [];
                @endphp
                <tr>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-light text-danger " type="button"
                                id="dropdownMenuButton1" style="border-radius: 50px" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-vertical"></i>
                            </button>
                            <ul class="dropdown-menu shadow " style="font-size: 13px" aria-labelledby="dropdownMenuButton1" >
                                <li>
                                    @if($item->is_locked == 1)
                                    <button class="dropdown-item btnlocked text-primary" data-id ="{{$item->id}}" data-lock="0">Unlock <i class="fas fa-unlock text-secondary" style="float: right;"></i></button>
                                    @else
                                    <button class="dropdown-item btnlocked" data-id ="{{$item->id}}" data-lock="1">Lock <i class="fas fa-lock text-secondary" style="float: right;"></i></button>
                                    @endif
                                    
                                </li>
                                <li>
                                    <button class="dropdown-item">Set as Separated <i class="fas fa-ellipsis" style="float: right;"></i></button>
                                </li>
                                <li>
                                    <button class="dropdown-item text-danger">Force Account <br> Verification/Change Password</button>
                                </li>
                            </ul>
                        </div>      
                    </td>
                    <td>
                        {{ $Employee_No }}
                    </td>
                    <td>
                        {{ $Fullname }}
                    </td>
                    <td>{{ $item->email }}</td>
                    <td>
                        @foreach ($roles as $role)
                            @if ($role->entity_id == $item->id)
                                <span class="badgeroles"
                                   >{{ $role->name }}</span>
                                  
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @if($item->is_locked == 1)
                        <span class="badge bg-dark">LOCKED <i class="fas fa-lock"></i></span>
                        @else

                        @if ($item->is_active == 1)
                            <span class="badge bg-success">ACTIVE</span>
                        @else
                            <span class="badge bg-secondary">INACTIVE</span>
                        @endif

                        @endif

                    </td>
                    <td>{{ date('h:ia , M j,Y ', strtotime($item->last_login)) }}</td>
                    <td>{{ date('h:ia , M j,Y ', strtotime($item->created_at)) }}</td>
                    <td>
                        <div class="btn-group">
                           
                            <button data-bs-toggle="modal" data-bs-target="#edit{{ $item->id }}"
                                class="btn btn-light btn-sm text-primary"><i
                                    class="fas fa-pen"></i></button>
                            @include('components.modal', [
                                'id'             => 'edit' . $item->id,
                                'modalsize'      => 'modal-lg',
                                'modaltitle'     => 'Update Users',
                                'type'           => 'UpdateUsers',
                                'data'           => $item,
                                'RoleSelection'  => $RoleSelection,
                                'roles'          => $roles,
                                'Employee_No'    =>$Employee_No,
                                'Fullname'       => $Fullname,
                                'userID'         => $item->id
                            ])

                        </div>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td style="text-align:center" colspan="9">

                    <lord-icon src="https://cdn.lordicon.com/zniqnylq.json" trigger="loop" delay="5000"
                        style="width:100px;height:100px;">


                    </lord-icon>
                    <h6 style="font-weight: bold"> No Employee Data Found</h6>
                </td>
            </tr>

        @endif
    </tbody>
</table>


<script>
    $(document).ready(function() {
        $('.btnlocked').click(function(){
            var id = $(this).data('id');
            var lock = $(this).data('lock');
          Action.LockUSer(id,lock,function(res){
            if(res == 'success'){
                Fetch.ShowALert("Status Changed Successfully!");
                if($('#search').val()){
                    Fetch.getAllUsers($('#search').val());
                    return;
                }
                Fetch.getAllUsers();
            }
          })
        })
    });
</script>
