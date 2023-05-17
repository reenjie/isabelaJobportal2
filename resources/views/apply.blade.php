@extends('layouts.homepage',["register"=> true , "activePage"=>'opportunities'])
@section('content')
    <style>
        body {
            overflow-y: hidden;
        }
    </style>

    <main>
        <div class="row" id="JobDetails">
            <div class="col-md-12">
                <button onclick="window.location.href='/' " class="btn btn-light text-primary mb-2"
                    style="font-size:14px"><i class="fas fa-arrow-left"></i> Back Home</button>

                <h6 style="float:right">Date Published : {{ date('F j, Y',strtotime($search->date_posted)) }}


                </h6>
                <br>
                <div style="">
                  
                   <div>
                    <h2 style="font-weight:bold">{{ $search->position }}
                        <button style="float:right" class="customaddBtn px-5 py-2">Apply <i class="fas fa-arrow-circle-right"></i></button>
                    </h2>
                    <h6 style="font-weight:normal">{{ $search->office }}
                   </div>
    
                </div>
              
            
              
                </h6>

                <hr>
                <div class="details">
                    <h6 style="font-size:12px;font-weight:bold;color:gray">JOB INFORMATION</h6>

                    <h6>
                        Plantilla No :
                    </h6>

                    <p style="font-weight:bold">{{ $search->plantilla_no }}</p>
                
                    <h6>
                        Description :
                    </h6>

                    <h6>
                        Monthly Salary :
                    </h6>

                    <p style="font-weight:bold">1/1 ( &#8369;{{ number_format($search->monthly_sal) }} )</p>

                    <p style="font-weight:bold">{{ $search->description }}</p>
                    <h6>
                        Educational Background :
                    </h6>

                    <p style="font-weight:bold">{{ $search->education_background }}</p>
                    <h6>
                        Competencies :
                    </h6>

                    <p style="font-weight:bold">{{ $search->competencies }}</p>

                    <h6>
                        Trainings :
                    </h6>

                    <p style="font-weight:bold">{{ $search->trainings }}</p>

                    <h6>
                        Eligibility :
                    </h6>

                    <p style="font-weight:bold">{{ $search->eligibility }}</p>

                </div>
                <hr>


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
