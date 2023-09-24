@extends('layouts.homepage',["register"=> true , "activePage"=>'myaccountpage'])

@section('content')
    <main>
        @php
            $user = Auth::guard('applicants')->user();
        @endphp
        <style>
            .fnm{
                font-size:14px;color:#2E4374;
            }
        </style>
     <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                 

                   <table class="table table-bordered">
                    <tr class="table-primary" >
                        <th colspan="3" style="text-align: center">   <h5 style="color:#2E4374;text-transform:uppercase;font-size:14px;font-weight:bold">My Information</h5></th>
                    </tr>
                    <tr>
                        <td class="fnm">
                            First Name
                        </td>
                        <td>
                          {{$user->first_name}}
                        </td>
                    
                    </tr>
                    <tr>
                        <td class="fnm">
                            Middle Name
                        </td>
                        <td>
                          {{$user->middle_name}}
                        </td>
                    </tr>
                    <tr>
                        <td class="fnm">
                          Last Name
                        </td>
                        <td>
                          {{$user->last_name}}
                        </td>
                    </tr>

                    <td class="fnm">
                        Birth Date
                      </td>
                      <td>
                        {{date('F j,Y',strtotime($user->dob))}}
                      </td>
                  </tr>
                  <tr>
                    <td class="fnm">
                     Gender
                    </td>
                    <td>
                      {{$user->sex}}
                    </td>
                </tr>
                <tr>
                    <td class="fnm">
                     Email 
                    </td>
                    <td>
                      {{$user->email}} 
                     
                    </td>
                  
                </tr>
                <tr>
                    <td class="fnm">
                     Mobile No
                    </td>
                    <td>
                    
                      #{{$user->mobile_no}}
                    </td>
                    <td>
                        <button class="btn btn-sm btn-light text-primary"><i class="fas fa-edit"></i></button>
                    </td>
                </tr>
                   </table>
                   <br>
                   <h5 style="color:#2E4374;text-transform:uppercase;font-size:14px">Upload supporting Documents <i class="fas fa-upload"></i></h5>
                   <div class="row mb-3">
                    <div class="col-md-4">
                        <button class="btn btn-dark btn-sm w-100"> PDS </button>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-dark btn-sm w-100"> BIR ID </button>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-dark btn-sm w-100"> NBI </button>
                    </div>
                   </div>

                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <h5 style="color:#2E4374;text-transform:uppercase;font-size:14px;font-weight:bold">My Applications</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">An item</li>
                        <li class="list-group-item">A second item</li>
                        <li class="list-group-item">A third item</li>
                        <li class="list-group-item">A fourth item</li>
                        <li class="list-group-item">And a fifth one</li>
                      </ul>
                </div>
            </div>
        </div>
     </div>
    </main>
@endsection