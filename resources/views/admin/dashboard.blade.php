@extends('layouts.homeLayout',['pageTitle'=>"Dashboard", "active"=>"dashboard"])

@section('content')
<div class="container-fluid ">
  
    <div class="row mb-4">
      <div class="col-md-3 d-block">
        @include('admin.components.dashboardCard', [
          'title' => 'New Applications',
          'extra' => 'As of: '.date('F j,Y'),
          'data' => count($newApplicants),
          'style' => 'border-left: 10px solid #E76161; background-color:#FFF3E2',
          'iconClass' => 'fas fa-folder-open',
      ])
      </div>
      <div class="col-md-3">
        @include('admin.components.dashboardCard', [
          'title' => 'Applicants',
          'data' => count($applicants),
          'style' => 'border-left: 10px solid #19A7CE; background-color:#FFF3E2',
          'iconClass' => 'fas fa-users',
      ])
      </div>
      <div class="col-md-3">
        @include('admin.components.dashboardCard', [
          'title' => 'Pending Applications',
          'data' => count($pending),
          'style' => 'border-left: 10px solid #FFD95A; background-color:#FFF3E2',
          'iconClass' => 'fas fa-sync',
      ])
      </div>
      <div class="col-md-3">
        @include('admin.components.dashboardCard', [
          'title' => 'Overall Total',
          'data' => count($overall),
          'style' => 'border-left: 10px solid #394867; background-color:#FFF3E2',
          'iconClass' => 'fas fa-info-circle',
      ])
      </div>
    </div>

 <div class="row">
    <div class="col-md-8 mb-2">
      @include('admin.charts.canvaBar')
    </div>

    <div class="col-md-4 mt-2 mb-2 ">
    <h6 style="font-size: 12px;" class="mt-3">Filled Job Positions</h6>

      <div class="table-responsive p-4" style="height: 230px;overflow-Y:scroll" >
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Positions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($filledJobpost as $item)
            <tr>
              <th scope="row" class="text-success">{{$item->title}}</th>
          
           
            </tr>
            @endforeach
          
         
          </tbody>
        </table>
    
      </div>
    </div>


   

    </div>
    <br><br>
    <div class="row">
      <div class="col-md-6 mb-2 ">
        <div class="card shadow p-3">
         <div class="card-body">
           @include('admin.charts.pie',['applicants'=>$applicants])
         </div>
        </div>
       </div>
       <div class="col-md-6 table-responsive">
         <div class="card shadow p-3">
           <div class="card-body">
             @include('admin.charts.bar',['ages'=>$ages])
           </div>
          </div>
      
       </div>
    </div>
</div>
@endsection
