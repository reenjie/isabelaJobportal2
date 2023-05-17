
<div class="table-responsive">
    <table style="font-size:14px" class="table  table-striped" id="users">
        <thead>
            <tr class="" style="text-transform:uppercase;font-weight:normal;font-size:13px">

                <th></th>
                <th scope="col">Name</th>
                <th scope="col">Age</th>
                <th scope="col">Contact Information</th>
                <th scope="col">Sex</th>
                <th scope="col">Position Applied For</th>
                <th scope="col">Date Applied</th>
                <th scope="col">Status</th>
                <th scope="col">Submitted Requirements</th>
            </tr>
        </thead>
        <tbody>

            @if (count($applications) >= 1)
                @foreach ($applications as $item)
                    @php
                        foreach ($applicants as $key => $user) {
                            if ($user->id == $item->applicant_id) {
                                $fullName = $user->last_name . ' , ' . $user->first_name . ' ' . $user->middle_name;
                                $dobs = $user->dob;
                                $email = $user->email;
                                $mobile_no = $user->mobile_no;
                                $sex = $user->sex;
                                $userID = $user->id;
                            }
                        }
                    $dateapplied = '';
                    @endphp
                
                    <tr>

                        <td>
                            @if($item->status >=1)
                            <div class="dropdown">
                                <button class="btn btn-light text-danger btn-sm " type="button"
                                    id="dropdownMenuButton1" style="border-radius: 50px;border:1px solid gray"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-vertical"></i>
                                </button>
                                <ul class="dropdown-menu shadow " style="font-size: 13px"
                                    aria-labelledby="dropdownMenuButton1">
                                    <li>
                                        <button class="dropdown-item">Set as Hired </button>
                                    </li>

                                    <li>
                                        <button class="dropdown-item">Resend Email Invitation</i></button>
                                    </li>
                                    @if ($item->status != 2)
                                        <li>
                                            <button class="dropdown-item">Resend Acknowledgement Email</button>
                                        </li>

                                        <li>
                                            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#setInterview{{ $item->id }}">Set Interview</button>
                                           
                                        </li>
                                    @endif
                                    <li>
                                        <hr>
                                        <button data-id="{{$item->id}}"  class="dropdown-item btnnotqualified">Not Qualified</button>
                                    </li>
                                </ul>
                                @include('components.modal', [
                                    'id'             => 'setInterview' . $item->id,
                                    'modalsize'      => 'modal-lg',
                                    'modaltitle'     => 'Set Interview for : '.$fullName,
                                    'type'           => 'setinterview',
                                    'data'           => $item,
                                    'itemID'         => $item->id,
                                    'jobtitle'       => $jobtitle
                                ])
                            </div>
                            @endif
                        </td>
                        <td>
                            {{ $fullName }}
                        </td>
                        <td>
                            @php
                                $dob = new DateTime($dobs);
                                $today = new DateTime(date('Y-m-d'));
                                $diff = $today->diff($dob);
                                $age = $diff->y;
                                echo $age;
                            @endphp
                        </td>
                        <td>
                            {{ $email }}
                            <br>
                            <i class="fas fa-phone text-secondary" style="font-size:13px"></i># {{ $mobile_no }}
                        </td>
                        <td>
                            <span style="text-transform: uppercase;font-size:12px;">{{ $sex }}</span>
                        </td>
                        <td>
                            @if ($item->applicant_id == $userID)
                                @php
                                    $dateapplied = $item->date_created;
                                    $status = $item->status;
                                @endphp
                                @foreach ($jobpost as $job)
                                    @if ($job->id == $item->job_post_id)
                                    @php
                                        $jobtitle = $job->title;
                                    @endphp
                                        <span style="text-transform: uppercase;font-weight:bold"
                                            class="text-secondary">{{ $job->title }}</span>
                                    @endif
                                @endforeach
                            @endif
                          

                        </td>
                        <td>
                            {{ date('h:ia M j, Y', strtotime($dateapplied)) }}
                        </td>
                        <td>
                            @switch($status)
                                @case(0)
                                    <span class="badge bg-secondary">NOT QUALIFIED</span>
                                @break

                                @case(1)
                                    <span class="badge bg-warning">PENDING</span>
                                @break

                                @case(2)
                                    <span class="badge bg-primary">FOR INTERVIEW</span>
                                    <br>
                                    <span class="text-danger" style="font-weight: bold;font-size:12px">
                                        {{ date('M j,Y  h:ia ', strtotime($item->interview_date)) }}
                                    </span>
                                @break
                            @endswitch
                        </td>
                        <td>
                            <button data-bs-toggle="tooltip" data-bs-placement="top" title="Submitted Documents"
                                class="position-relative btn btn-light btn-sm text-info"
                                style="border-radius: 20px;border:1px solid gray"><i class="fas fa-folder"></i>
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    3
                                </span>
                            </button>
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
</div>


<script>
    $(document).ready(function() {
        $('.btnnotqualified').click(function() {
            var id = $(this).data('id');

            var jobpost = $('#filterJobpost').val();
            var status = $('#filterstatus').val();
            var search = $('#search').val();
         
            swal({
                    title: "Confirm Action",
                    text: "Are you sure you want to mark this applicant `Not Qualified` ? ",
                    icon: "warning",
                    buttons: ['No','Yes'],
                    dangerMode: true,
                })
                .then((willMark) => {
                    if (willMark) {
                       Action.MarkApplicant_Status(id,'notqualified',null,function(res){
                       if(res == 'success'){
                        Fetch.getAllapplications(search,status,jobpost);
                        return;
                       }
                       })
                    }
                });
        })

    });
</script>
