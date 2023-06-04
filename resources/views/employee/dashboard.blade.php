@extends('layouts.homeLayout',['pageTitle'=>"Dashboard", "active"=>"dashboard"])

@section('content')
<div class="container-fluid ">
    
         
  <div class="row mt-3">
    <div class="col-md-5">
      <h5 class="text-secondary">My Request <i class="fas fa-paper-plane"></i></h5>
      <div class="card shadow mb-2" style="border-left:10px solid #E57C23 ">
        <div class="card-body">
          <div style="float: right;">
            <span class="badge bg-danger">
        
              {{$totalPending}}
            </span>
          </div>
          <h5>Pending </h5>  
        </div>
      </div>

      <div class="card shadow mb-2" style="border-left:10px solid #AEE2FF ">
        <div class="card-body">
          <div style="float: right;">
            <span class="badge bg-danger">{{$totalonProgress}}</span>
          </div>
          <h5>On Progress </h5>  
        </div>
      </div>

      <div class="card shadow mb-2" style="border-left:10px solid #AAC8A7 ">
        <div class="card-body">
          <div style="float: right;">
            <span class="badge bg-danger">{{$totalapprove}}</span>
          </div>
          <h5>Approved </h5>  
        </div>
      </div>

      <div class="card shadow mb-2" style="border-left:10px solid #F45050 ">
        <div class="card-body">
          <div style="float: right;">
            <span class="badge bg-danger">{{$totaldecline}}</span>
          </div>
          <h5>Disapproved </h5>  
        </div>
      </div>

      <div class="card shadow mb-2" style="border-left:10px solid #FA9884 ">
        <div class="card-body">
          <div style="float: right;">
            <span class="badge bg-danger">{{$totalcancel}}</span>
          </div>
          <h5>Cancelled </h5>  
        </div>
      </div>
    </div>
    <div class="col-md-7">
      <h5 class="text-secondary">Announcements <i class="fas fa-bell"></i></h5>
     <div class="p-4" style="height:60vh;overflow-y:scroll">
      <ul class="list-group list-group-flush">
       
        @foreach ($announcements as $ann)
        <li class="list-group-item">
          <h4 class="text-dark">{{$ann->title}}</h4>
          <span class="">
            {!!$ann->content!!}
          </span>

        </li>
        @endforeach
        
      </ul>
     </div>
    
    </div>
  </div>


</div>
@endsection
