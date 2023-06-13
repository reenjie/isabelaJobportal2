@extends('layouts.homeLayout',['pageTitle'=>"Reports","active"=>"reports"])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow h-100">
                <div class="card-body">
                    <i class="fas fa-cogs mb-2 text-secondary"></i>
         
                    <select name="" class="form-select" id="">
                        <option value="">Select to Generate</option>
                        <option value="">Pending Applications</option>
                        <option value="">Hired Applicants</option>
                        <option value="">Filled Job Positions</option>
                        <option value="">For Interview Applicants</option>
                        <option value="">Publish Job Post</option>
                        <option value="">Filled Job Positions</option>
                        <option value="">Today Logs</option>
                        <option value="">Select Logs</option>
                       
                    </select>
                 
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow h-100">
                <div class="card-body">
                    <h6 class=" text-center text-secondary mb-3 " style="text-transform: uppercase">Options</h6>
                    <button class="btn btn-primary form-control"><span style="font-size:10px">PRINT</span> <i class="fas fa-print"></i></button>
                    
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-body">
                    <div style="text-align:center" >
    
                        <lord-icon src="https://cdn.lordicon.com/zniqnylq.json" trigger="loop" delay="5000"
                            style="width:100px;height:100px;">
    
                        </lord-icon>
                        <h6 style="font-weight: bold"> No Selected Options</h6>
                    </div>

                </div>
            </div>
        </div>
    </div>
 
</div>
@endsection
