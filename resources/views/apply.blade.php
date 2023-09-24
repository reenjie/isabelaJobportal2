@extends('layouts.homepage',["register"=> true , "activePage"=>'opportunities'])
@section('content')
    <style>
     
    </style>
 
    <main>
        <div class="row">
            <div class="col-md-12">
                <button onclick="window.location.href='/' " class="btn btn-light text-primary mb-2"
                    style="font-size:14px"><i class="fas fa-arrow-left"></i> Back Home</button>

                <h6 style="float:right">Date Published : {{ date('F j, Y',strtotime($search[0]->date_posted)) }}


                </h6>
                <br>
                <div class="mb-2">
                  
                   <div>
                    <h2 style="font-weight:bold;color:#2E4374">

                        <div class="row">
                            <div class="col-md-10">
                                {{ $search[0]->position }}
                            </div>
                        </div>
                     
                        @php
                        $checkifApplied = [];
                            if(Auth::guard('applicants')->check()){
                                $route = route('save.jobapplication',['apply'=>$search[0]->id]);
                                $checkifApplied =  DB::select('SELECT * FROM `applications` where applicant_id = '.Auth::guard('applicants')->user()->id.' and job_post_id ='.$search[0]->id.' ');
                            }else {
                                $route = route('login',['apply'=>$search[0]->id]);
                            }
                          
                          
                        @endphp
                        @if(count($checkifApplied)>=1)
                        <span class="badge bg-primary" style="float: right;font-size:14px">APPLIED <i class="fas fa-check-circle"></i></span>
                        @else
                        <button style="float:right" id="apply" class="customaddBtn px-5 py-2">Apply <i class="fas fa-arrow-circle-right"></i></button>
                        @endif
                    </h2>
                    <h6 style="font-weight:normal">{{ $search[0]->office }}
                   </div>
    
                </div>
                
                <script>
                    $('#apply').click(function(){            
               swal({
                title: "CONFIRMATION",
                text: "Please ensure that all the required items and their respective attachments are included",
                icon: "warning",
                buttons: true,
                dangerMode: false,
                })
                .then((confirm) => {
                if (confirm) {
                    window.location.href='{{$route}}';
                } 
                });
                    
                        // onclick=" " 
                    })
                </script>
            
              
                </h6>
                <br>

                <hr>
                <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
                <div class="table-responsive">
                    <table class="table table-bordered" style="text-align: center;font-family: 'Montserrat', sans-serif;">
                        <thead>
                          <tr class="table-primary">
                            <th scope="col" colspan="2" style="font-size:13px;font-weight:normal;text-align:center">JOB INFORMATION</th>
                           
                          </tr>
                        </thead>
                        <tbody>
                         <tr>
                            <td style="width:300px">
                             <h6 style="text-transform:uppercase;font-size:13px" >   Plantilla No </h6>
                            </td>
                            <td>
                                {{ $search[0]->plantilla_no }}
                            </td>
                         </tr>
                         <tr>
                            <td style="width:300px">
                             <h6 style="text-transform:uppercase;font-size:13px" >   Description </h6>
                            </td>
                            <td>
                              
                                {{ $search[0]->description }}
                            </td>
                         </tr>
                         <tr>
                            <td style="width:300px">
                             <h6 style="text-transform:uppercase;font-size:13px" >    Monthly Salary </h6>
                            </td>
                            <td>
                                <p style=""><span class="badge badge-primary bg-secondary">{{ $search[0]->salary }}</span>  &#8369;{{ number_format($search[0]->monthly_sal) }} </p>
                            </td>
                         </tr>
                       
                         <tr>
                            <td style="width:300px">
                             <h6 style="text-transform:uppercase;font-size:13px" >     Educational Background : </h6>
                            </td>
                            <td>
                                <p >{{ $search[0]->education_background }}</p>
                            </td>
                         </tr>
                         <tr>
                            <td style="width:300px">
                             <h6 style="text-transform:uppercase;font-size:13px" >      Competencies  </h6>
                            </td>
                            <td>
                               <p>{{ $search[0]->competencies }}</p>
                            </td>
                         </tr>
                         <tr>
                            <td style="width:300px">
                             <h6 style="text-transform:uppercase;font-size:13px" >    Trainings </h6>
                            </td>
                            <td>
                                {{ $search[0]->trainings }}
                            </td>
                         </tr>
                         <tr>
                            <td style="width:300px">
                             <h6 style="text-transform:uppercase;font-size:13px" >    Eligibility </h6>
                            </td>
                            <td>
                                {{ $search[0]->eligibility }}
                            </td>
                         </tr>
                        </tbody>
                      </table>
                </div>
                {{-- <div class="details">
                    <h6 style="font-size:12px;font-weight:bold;color:gray">JOB INFORMATION</h6>

                    <h6>
                        Plantilla No :
                    </h6>

                    <p style="font-weight:bold">{{ $search[0]->plantilla_no }}</p>
                
                    <h6>
                        Description :
                    </h6>

                    <h6>
                      
                    </h6>
                  
                 

                    <p style="font-weight:bold">{{ $search[0]->description }}</p>
                    <h6>
                       
                    </h6>

                
                    <h6>
                     
                    </h6>

                    <p style="font-weight:bold"></p>

                    <h6>
                        :
                    </h6>

                    <p style="font-weight:bold"></p>

                    <h6>
                         :
                    </h6>

                    <p style="font-weight:bold"></p>

                </div> --}}
               


            </div>

        </div>

    </main>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary d-none" id="clickview" data-bs-toggle="modal"
        data-bs-target="#exampleModal">

    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <button style="float:right" type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                    <br>
                    <h5>For Applicants who are interested in any of the position posted you are required to:</h5>

                    <h6>Steps</h6>
                    <ol>
                        <li> Register by filling out the required information </li>
                        <li> Verify email by confirming registration sent through your email.</li>
                        <li>Login using your account created</li>
                        <li> Browse vacancies and apply for the desired position</li>
                        <li>
                            Submit documents in PDF format consolidated in one file
                            <ul>
                                <li>Application Letter</li>
                                <li>Personal Data Sheet</li>
                                <li>Eligibility </li>
                                <li>Certificate & Training</li>
                            </ul>
                        </li>
                        <li> An acknowledgement receipt notification will be sent thru email</li>
                        <li>Wait for the interview schedule sent thru email </li>
                        <li> Monitor jobs.isabelacity portal for the result </li>
                    </ol>

                    <h5> For the newly hired/promoted employees</h5>
                    <ol>
                        <li> Send/Submit documents in PDF format consolidated in one file

                            <ul>
                                <li>Personal Data Sheet (CS Form 212, revised 2017) with passport size picture</li>
                                <li>Work Experience Sheet (CS Form 212)</li>
                                <li>Certificate of trainings</li>
                                <li>PRC License and Board Rate</li>
                                <li>Statement of Assets and Liabilities</li>
                                <li>NBI Clearance</li>
                                <li>Medical Certificate</li>
                                <li>Transcript of Records</li>
                                <li>PSA Birth Certificate</li>
                                <li>BIR Form 1902</li>
                            </ul>
                        </li>
                    </ol>
                    <hr>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            Don't show this again
                        </label>
                    </div>



                </div>
            </div>
        </div>
    </div>

    <script>
        if (localStorage.getItem('openNotes') !== null) {
            if (localStorage.getItem('openNotes') == 0) {
                $('#clickview').click();
            }
        } else {
            localStorage.setItem('openNotes', 0);
        }

        $('#flexCheckChecked').click(function() {
            if ($(this).prop('checked') == true) {
                localStorage.setItem('openNotes', 1);
            } else {
                localStorage.setItem('openNotes', 0);
            }
        })

        $('#openbars').click(function(){
            $('#navlinks').css('right','0px');
        })

        /* Clicking outside the Element */
        $(document).on('click', function(event) {
        if (!$(event.target).closest('#navlinks').length) {
          //  
            if($('#navlinks').css('right') === '0px'){
                $('#navlinks').css('right','-200px');
            }
        }
        });
    </script>
@endsection
