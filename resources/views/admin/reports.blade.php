@extends('layouts.homeLayout',['pageTitle'=>"Reports","active"=>"reports"])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow h-100">
                <div class="card-body">
                   
         
                    <select name="" class="form-select" id="">
                        <option value="">Select to Generate</option>
                        <option value="">Pending Applications</option>
                        <option value="">Hired Applicants</option>
                        <option value="">Filled Job Positions</option>
                        <option value="">For Interview Applicants</option>
                       
                    </select>
                 
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow h-100">
                <div class="card-body">
                    <h6 class=" text-center text-secondary mb-3 " style="text-transform: uppercase">Options</h6>
                    <button class="btn btn-primary">Print <i class="fas fa-print"></i></button>
                    <button class="btn border border-warning text-warning">Download <i class="fas fa-download"></i></button>
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-body">
                    
                </div>
            </div>
        </div>
    </div>
 
</div>
@endsection
