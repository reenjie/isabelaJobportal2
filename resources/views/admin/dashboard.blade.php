@extends('layouts.homeLayout',['pageTitle'=>"Dashboard", "active"=>"dashboard"])

@section('content')
<div class="container-fluid ">
  
    <div class="row">
      <div class="col-md-3">
        @include('admin.components.dashboardCard', [
          'title' => 'New Applications',
          'data' => 100,
          'style' => 'border-left: 10px solid #E76161; background-color:#FFF3E2',
          'iconClass' => 'fas fa-folder-open',
      ])
      </div>
      <div class="col-md-3">
        @include('admin.components.dashboardCard', [
          'title' => 'Applicants',
          'data' => 100,
          'style' => 'border-left: 10px solid #19A7CE; background-color:#FFF3E2',
          'iconClass' => 'fas fa-users',
      ])
      </div>
      <div class="col-md-3">
        @include('admin.components.dashboardCard', [
          'title' => 'Pending Records',
          'data' => 100,
          'style' => 'border-left: 10px solid #FFD95A; background-color:#FFF3E2',
          'iconClass' => 'fas fa-sync',
      ])
      </div>
      <div class="col-md-3">
        @include('admin.components.dashboardCard', [
          'title' => 'Overall Total',
          'data' => 100,
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
    <h6 style="font-size: 12px;" class="mt-3">Educational Attainment Distribution</h6>

      <div class="table-responsive" >
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Type of Education</th>
              <th scope="col">Count</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">BSIT</th>
              <td>Mark</td>
              <td>Otto</td>
           
            </tr>
         
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
           @include('admin.charts.pie')
         </div>
        </div>
       </div>
       <div class="col-md-6 table-responsive">
         <div class="card shadow p-3">
           <div class="card-body">
             @include('admin.charts.bar')
           </div>
          </div>
      
       </div>
    </div>
</div>
@endsection
