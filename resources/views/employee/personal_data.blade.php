@extends('layouts.homeLayout',['pageTitle'=>"Personal Data","active"=>"personal_data"])

@section('content')
<div class="container-fluid">
    {{-- <div class="row p-5">
        <div class="col-md-3">
            <h6 style="font-size:13px;text-transform:uppercase">Lastname</h6>
            <span style="font-style:italic">Caimor</span>
        </div>
        <div class="col-md-3">
            <h6 style="font-size:13px;text-transform:uppercase">Firstname</h6>
            <span style="font-style:italic">Caimor</span>
        </div>
        <div class="col-md-3">
            <h6 style="font-size:13px;text-transform:uppercase">middlename</h6>
            <span style="font-style:italic">Caimor</span>
        </div>
        <div class="col-md-3">
            <h6 style="font-size:13px;text-transform:uppercase">Extension name</h6>
            <span style="font-style:italic">Caimor</span>
        </div>
    </div> --}}
    <style>
        tr td {
            color:"green"
        }
    </style>
    @php
        $pds = $pdsdata[0];
        $resadd = json_decode($pds->res_addcress_json);  
        $peradd = json_decode($pds->perm_address_json);
        $spouse = json_decode($pds->spouse_json);
        $parents = json_decode($pds->parents_json);
    @endphp
   <div class="p-5 table-responsive ">
    <table class="table table-bordered table-striped text-center "  >
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
        <tr  style="font-size:12px;text-transform:uppercase;">
            <th>LASTNAME</th>
            <th>FIRSTNAME</th>
            <th>MIDDLENAME</th>
            <th colspan="2">EXT nAME</th>
         </tr>
        <tr >
            <td>{{$pds->last_name}}</td>
            <td>{{$pds->first_name}}</td>
            <td>{{$pds->middle_name}}</td>
            <td colspan="2">{{$pds->ext_name}}</td>
        </tr>
        <tr style="font-size:12px;text-transform:uppercase">
            <th>sex</th>
            <th>civil status</th>
            <th >date of birth</th>
            <th colspan="2">place of birth</th>
           
         </tr>
         <tr >
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
            <th >philhealth no</th>
            <th >tin no</th>
            <th >sss no</th>
         </tr>
         <tr>
            <td>{{$pds->gsis_no}}</td>
            <td>{{$pds->pag_ibig_no}}</td>
            <td>{{$pds->philhealth_no}}</td>
            <td >{{$pds->tin_no}}</td>
            <td >{{$pds->sss_no}}</td>
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
            <th >Zip</th>
          
         </tr>
         <tr>
        
            <td colspan="3">{{$resadd->address1}}</td>
            <td></td>
            <td >{{$resadd->zip}}</td>
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
            <th >Zip</th>
          
         </tr>
         <tr>
          
            <td colspan="3">{{$peradd->address1}}</td>
            <td></td>
            <td >{{$peradd->zip}}</td>
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
            <th colspan="2" >Ext. Name</th>
          
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
                $parentName = explode(" ", $spouse->first_name);
                $pfirstName = $parentName[0];
                $pmiddleName = $parentName[1];
                $plastName = implode(" ", array_slice($parentName, 2));

            @endphp
            <td>{{$plastName}}</td>
            <td>{{$pfirstName}}</td>
            <td>{{$pmiddleName}}</td>
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
            <td></td>
            <td></td>
            <td></td>
            <td colspan="3"></td>
        </tr>
      
      
     
    </table>
   </div>

</div>
@endsection
