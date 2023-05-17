@extends('layouts.homeLayout',['pageTitle'=>"Users","active"=>"users"])

@section('content')
<div class="container-fluid">
    <div class="card shadow">

        <div class="card-body">
           

            <div class="row">
                <div class="col-md-6">
                    <button class="customaddBtn mb-2" data-bs-toggle="modal" data-bs-target="#add_User"><i
                        class="fas fa-plus-circle"></i> New User</button>
                        @include('components.modal', [
                            'id' => 'add_User',
                            'modalsize' => 'modal-lg',
                            'modaltitle' => 'New User',
                            'type' => 'addNewUsers',
                        ])
                    <button class="customaddBtn px-3" onclick="window.location.reload()">Reload <i class="fas fa-sync"></i></button>
                </div>
                <div class="col-md-6">
                     
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text text-secondary" id="addon-wrapping"><i class="fas fa-search icons"></i></span>
                        <input type="text" class="form-control  " style="text-transform:uppercase" id="search" autofocus placeholder="Search for Firstname,Lastname or Employee number" aria-label="Username"
                            aria-describedby="addon-wrapping">                
                      </div>
                </div>
            </div>
       
            <div class="table-responsive" id="usersdata" style="height:80vh;overflowY:scroll">
                <div style="text-align:center;padding:150px">
                    <div class="spinner-border justify-content-center" style="width: 3rem; height: 3rem;" role="status">
                       
                      </div>
                      <br> 
                      <span style="font-size:14px;font-weight:bold">LOADING</span>
                </div>
                    
            </div>
         
        </div>
    </div>
 
</div>
<script src="{{asset('js/fetch.js')}}"></script>
<script>
    $(document).ready(function(){ 
        Fetch.getAllUsers();
        $('#search').keyup(function(){
            Fetch.getAllUsers($(this).val());
        })
    })
</script>
@include('components.alerts')
@endsection
