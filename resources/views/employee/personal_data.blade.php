@extends('layouts.homeLayout',['pageTitle'=>"Personal Data","active"=>"personal_data"])

@section('content')
<div class="container-fluid">
    <style>
        tr td {
            color: "green"
        }
    </style>
    @php
    $pds=[];
    $resadd=[];
    $peradd=[];
    $spouse=[];
    $parents=[];
    if(count($pdsdata)>=1){
    $pds = $pdsdata[0];
    $resadd = json_decode($pds->res_addcress_json);
    $peradd = json_decode($pds->perm_address_json);
    $spouse = json_decode($pds->spouse_json);
    $parents = json_decode($pds->parents_json);
    }
   
    @endphp

    @if(count($pdsdata)>=1)

    <div class="p-4 table-responsive ">

        @php
        $photo = DB::select('SELECT * FROM `profilepicture` where emp_id ='.Auth::user()->emp_id);
        @endphp

        <div class="text-center mb-3">
            @if(count($photo))
            <img src="{{  asset('public/uploads/'.$photo[0]->photo) }}" width="200" class="rounded" alt="">
            @else
            <img src="https://th.bing.com/th/id/R.ab01b0e99e6089d02c0957dafe4decba?rik=wKS4tLyfLP65SQ&riu=http%3a%2f%2fwww.newdesignfile.com%2fpostpic%2f2010%2f04%2femployee-icon_150781.jpg&ehk=sEVxAvyCDU7q5Sku99HeyE6JioZb1Dvl%2fMFft1DEGNM%3d&risl=&pid=ImgRaw&r=0" width="200" class="rounded" alt="">
            @endif

        </div>
        <table class="table table-bordered table-striped text-center ">
            <colgroup>
                <col style="width: 20%;">
                <col style="width: 20%;">
                <col style="width: 20%;">
                <col style="width: 20%;">
                <col style="width: 20%;">
            </colgroup>
            <tr class="table-secondary">
                <th colspan="5" style="text-align: center;font-size:13px;">
                    Profile
                </th>
            </tr>
            <tr style="font-size:12px;text-transform:uppercase;">
                <th>LASTNAME</th>
                <th>FIRSTNAME</th>
                <th>MIDDLENAME</th>
                <th colspan="2">EXT nAME</th>
            </tr>
            <tr>
                <td>{{$pds->last_name}}</td>
                <td>{{$pds->first_name}}</td>
                <td>{{$pds->middle_name}}</td>
                <td colspan="2">{{$pds->ext_name}}</td>
            </tr>
            <tr style="font-size:12px;text-transform:uppercase">
                <th>sex</th>
                <th>civil status</th>
                <th>date of birth</th>
                <th colspan="2">place of birth</th>

            </tr>
            <tr>
                <td>{{$pds->sex}}</td>
                <td>{{$pds->civil_status}}</td>
                <td>{{$pds->dob}}</td>
                <td colspan="2">{{$pds->birth_place}}</td>
            </tr>
            <tr style="font-size:12px;text-transform:uppercase">
                <th>height</th>
                <th>weight</th>
                <th colspan="3">bloodtype</th>


            </tr>
            <tr>

                <td>{{$pds->height}}</td>
                <td>{{$pds->weight}}</td>
                <td colspan="3">{{$pds->blood_type}}</td>
            </tr>
            <tr style="font-size:12px;text-transform:uppercase">
                <th>mobile no</th>
                <th>email address</th>
                <th colspan="3">tel no</th>


            </tr>
            <tr>

                <td>{{$pds->mobile_no}}</td>
                <td>{{$pds->email}}</td>
                <td colspan="3">{{$pds->tel_no}}</td>
            </tr>

            <tr style="font-size:12px;text-transform:uppercase">
                <th>gsis no</th>
                <th>pagibig no</th>
                <th>philhealth no</th>
                <th>tin no</th>
                <th>sss no</th>
            </tr>
            <tr>
                <td>{{$pds->gsis_no}}</td>
                <td>{{$pds->pag_ibig_no}}</td>
                <td>{{$pds->philhealth_no}}</td>
                <td>{{$pds->tin_no}}</td>
                <td>{{$pds->sss_no}}</td>
            </tr>
            <tr class="table-secondary">
                <th colspan="5" style="text-align: center;font-size:13px;">
                    Residential Address
                </th>
            </tr>
            <tr style="font-size:12px;text-transform:uppercase">
                <th>House / Block / Lot No.</th>
                <th>Street</th>
                <th colspan="3">Subdivision / Village</th>

            </tr>
            <tr>

                <td></td>
                <td>{{$resadd->address2}}</td>
                <td colspan="3"></td>
            </tr>

            <tr style="font-size:12px;text-transform:uppercase">
                <th colspan="3">Barangay , City / Municipality</th>
                <th>Province</th>
                <th>Zip</th>

            </tr>
            <tr>

                <td colspan="3">{{$resadd->address1}}</td>
                <td></td>
                <td>{{$resadd->zip}}</td>
            </tr>


            <tr class="table-secondary">
                <th colspan="5" style="text-align: center;font-size:13px;">
                    Permanent Address
                </th>
            </tr>
            <tr style="font-size:12px;text-transform:uppercase">
                <th>House / Block / Lot No.</th>
                <th>Street</th>
                <th colspan="3">Subdivision / Village</th>

            </tr>
            <tr>

                <td></td>
                <td>{{$peradd->address2}}</td>
                <td colspan="3"></td>
            </tr>

            <tr style="font-size:12px;text-transform:uppercase">
                <th colspan="3">Barangay , City / Municipality</th>
                <th>Province</th>
                <th>Zip</th>

            </tr>
            <tr>

                <td colspan="3">{{$peradd->address1}}</td>
                <td></td>
                <td>{{$peradd->zip}}</td>
            </tr>

            <tr class="table-secondary">
                <th colspan="5" style="text-align: center;font-size:13px;">
                    Spouse
                </th>
            </tr>
            <tr style="font-size:12px;text-transform:uppercase">
                <th>Last Name</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th colspan="2">Ext. Name</th>

            </tr>
            <tr>
                @php
                $spouseName = explode(" ", $spouse->first_name);
                $firstName = $spouseName[0];
                $middleName = $spouseName[1];
                $lastName = implode(" ", array_slice($spouseName, 2));

                @endphp
                <td>{{ $lastName}}</td>
                <td>{{$firstName}}</td>
                <td>{{$middleName}}</td>
                <td colspan="2"></td>
            </tr>


            <tr style="font-size:12px;text-transform:uppercase">
                <th>Occupation</th>
                <th>Bussiness / Employer</th>
                <th colspan="3">Bussiness Address</th>

            </tr>
            <tr>
                <td>{{$spouse->occupation}}</td>
                <td>{{$spouse->busEmployer}}</td>

                <td colspan="3">{{$spouse->busAddress}}</td>
            </tr>
            <tr class="table-secondary">
                <th colspan="5" style="text-align: center;font-size:13px;">
                    Father
                </th>
            </tr>
            <tr style="font-size:12px;text-transform:uppercase">
                <th>Last Name</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th colspan="2">Ext. Name</th>

            </tr>
            <tr>

                @php
                $fathersName = explode(" ", $parents->father->first_name);
                $ffirstName = $fathersName[0];
                $fmiddleName = $fathersName[1];
                $flastName = implode(" ", array_slice($fathersName, 2));

                @endphp
                <td>{{$flastName}}</td>
                <td>{{$ffirstName}}</td>
                <td>{{$fmiddleName}}</td>
                <td colspan="2"></td>
            </tr>

            <tr class="table-secondary">
                <th colspan="5" style="text-align: center;font-size:13px;">
                    Mother
                    <br>
                    (Maiden Name)
                </th>
            </tr>

            <tr style="font-size:12px;text-transform:uppercase">
                <th>Last Name</th>
                <th>First Name</th>
                <th colspan="3">Middle Name</th>


            </tr>
            <tr>
                @php
                if($parents->mother->first_name){
                $mothersName = explode(" ", $parents->mother->first_name);
                $mfirstName = $mothersName[0];
                $mmiddleName = $mothersName[1];
                $mlastName = implode(" ", array_slice($mothersName, 2));
                }else{

                $mfirstName = "";
                $mmiddleName ="";
                $mlastName = "";
                }


                @endphp
                <td>{{$mlastName}}</td>
                <td>{{$mfirstName}}</td>
                <td>{{$mmiddleName}}</td>
                <td colspan="3"></td>
            </tr>
            <tr class="table-secondary">
                <th colspan="5" style="text-align: center;font-size:13px;">
                    Childrens
                </th>
            </tr>

            <tr style="font-size:12px;text-transform:uppercase">
                <th colspan="2">Name</th>
                <th colspan="3">Date of Birth</th>
            </tr>

            @foreach ($pdsChild as $childs)
            <tr>
                <td colspan="2">{{$childs->name}}</td>
                <td colspan="3">{{date('F j ,Y',strtotime($childs->dob))}}</td>
            </tr>
            @endforeach

            <tr class="table-secondary">
                <th colspan="5" style="text-align: center;font-size:13px;">
                    Eligibilities
                </th>
            </tr>

            <tr style="font-size:12px;text-transform:uppercase">
                <th>
                    Eligibility
                </th>
                <th>Rating</th>
                <th>Date of Exam/Conferment</th>
                <th>Place of Exam/Conferment</th>
                <th>License No</th>
            </tr>
            @foreach ($pdseligibility as $elig)
            <tr>
                <td>{{$elig->name}}</td>
                <td>{{$elig->rating}}</td>
                <td>{{$elig->date_of_exam}}</td>
                <td>{{$elig->place_of_exam}}</td>
                <td>{{$elig->license_no}}
                    <br>
                    <span style="font-size:11px">RELEASE DATE: {{$elig->release_date}}</span>
                </td>
            </tr>
            @endforeach


        </table>
        <table class="table table-bordered table-striped text-center ">
            <colgroup>
                <col style="width: 20%;">
                <col style="width: 20%;">
                <col style="width: 20%;">
                <col style="width: 20%;">
                <col style="width: 20%;">
            </colgroup>
            <tr class="table-secondary">
                <th colspan="9" style="text-align: center;font-size:13px;">
                    Work Experiences
                </th>
            </tr>
            <tr style="font-size:12px;text-transform:uppercase">
                <th>
                    Date From
                </th>
                <th>Address</th>
                <th>Date to</th>
                <th>Position</th>
                <th>Agency/Company</th>
                <th>Monthly salary</th>
                <th>Salary grade</th>
                <th>Status of Appointment</th>
                <th>Gov't Service</th>
            </tr>

            @foreach ($pdsworkxp as $workxp)
            <tr>
                <td>{{$workxp->date_from}}</td>
                <td></td>
                <td>{{$workxp->date_to}}</td>
                <td>{{$workxp->position}}</td>
                <td>{{$workxp->agency_company}}</td>
                <td>{{$workxp->monthly_salary}}</td>
                <td>{{$workxp->salary_grade}}</td>
                <td>{{$workxp->status_appointment}}</td>
                <td>
                    @if($workxp->is_gov_service)
                    <span class="badge bg-success">YES</span>
                    @else
                    <span class="badge bg-warning">NO</span>
                    @endif
                </td>
            </tr>
            @endforeach

        </table>
        {{--
        pdsvolwork
pdstrainings
pdsreferences
        --}}

        <table class="table table-bordered table-striped text-center ">
            <colgroup>
                <col style="width: 20%;">
                <col style="width: 20%;">
                <col style="width: 20%;">
                <col style="width: 20%;">
                <col style="width: 20%;">
            </colgroup>
            <tr class="table-secondary">
                <th colspan="5" style="text-align: center;font-size:13px;">
                    Voluntary Works
                </th>
            </tr>
            <tr style="font-size:12px;text-transform:uppercase">
                <th>
                    Name
                </th>
                <th>Date From</th>
                <th>Date to</th>
                <th>No of Hours</th>
                <th>Designation</th>

            </tr>
            @foreach ($pdsvolwork as $vol)
            <tr>
                <td>{{$vol->name}}</td>
                <td>{{$vol->date_from}}</td>
                <td>{{$vol->date_to}}</td>
                <td>
                    {{$vol->no_of_hours}}
                </td>
                <td>{{$vol->position}}</td>
            </tr>

            @endforeach



        </table>


        <table class="table table-bordered table-striped text-center ">
            <colgroup>
                <col style="width: 20%;">
                <col style="width: 20%;">
                <col style="width: 20%;">
                <col style="width: 20%;">
                <col style="width: 20%;">
            </colgroup>
            <tr class="table-secondary">
                <th colspan="5" style="text-align: center;font-size:13px;">
                    Trainings
                </th>
            </tr>
            <tr style="font-size:12px;text-transform:uppercase">
                <th>
                    Name
                </th>
                <th>Date From</th>
                <th>Date to</th>
                <th>No of Hours</th>
                <th>Sponsor</th>

            </tr>

            @foreach ($pdstrainings as $train)
            <tr>
                <td>{{$train->name}}</td>
                <td>{{$train->date_from}}</td>
                <td>{{$train->date_to}}</td>
                <td>
                    {{$train->no_hours}}
                </td>
                <td>{{$train->sponsor}}</td>
            </tr>
            @endforeach


        </table>

        <table class="table table-bordered table-striped text-center ">
            <tr class="table-secondary">
                <th colspan="5" style="text-align: center;font-size:13px;">
                    References
                </th>
            </tr>
            <tr style="font-size:12px;text-transform:uppercase">
                <th>
                    Name
                </th>
                <th>Address</th>
                <th>Tel No.</th>
            </tr>
            @foreach ($pdsreferences as $ref)
            <tr>
                <td>{{$ref->name}}</td>
                <td>{{$ref->address}}</td>
                <td>{{$ref->contact_no}}</td>
            </tr>
            @endforeach


        </table>



    </div>
    @else 
    
    <div style="text-align: center;pointer-events:none;user-select:none" class="mt-5">
        <img src="https://th.bing.com/th/id/OIP.mexosehXrciNRvS4NohrwAAAAA?pid=ImgDet&rs=1" alt="" style="margin-top:50px">
        <br> <br>

      <h5 style="color:gray">  No Personal Data Found..</h5>
    </div>

    @endif

</div>
@endsection