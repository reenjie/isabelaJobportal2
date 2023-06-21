@extends('layouts.homeLayout',['pageTitle'=>"Reports","active"=>"reports"])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow h-100">
                <div class="card-body">
                    <i class="fas fa-cogs mb-2 text-secondary"></i>
         
                    <select name="" class="form-select" id="generate">
                        <option value="">Select to Generate</option>
                        <option value="1">Count of Pending Applications</option>
                        <option value="2">Hired Applicants</option>
                        <option value="3">Filled Job Positions</option>
                        <option value="4">For Interview Applicants</option>
                        <option value="5">Publish Job Post</option>
                        <option value="6">Filled Job Positions</option>
                        <option value="7">Today Logs</option>
                        <option value="8">Select Logs Range</option>
                       
                    </select>
                 
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow h-100">
                <div class="card-body">
                    <h6 class=" text-center text-secondary mb-3 " style="text-transform: uppercase">Options</h6>
                    <button class="btn btn-primary form-control" id="print" disabled><span style="font-size:10px">PRINT</span> <i class="fas fa-print"></i></button>
                    
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-body">
                    <div id="toprint">
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
 
</div>

<script>
    $('#generate').change(function(){
     var selection = $(this).val();  
     $('#toprint').html('<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>');
       $.ajax({
            url: "{{route('generate.page')}}",
            method: "GET",
            data: { selection:selection },
            success: function(response) {
                $('#toprint').html(response);
                $('#print').removeAttr('disabled');
            }
});
    })

    $('#print').click(function(){
        var content = $('#toprint').html(); 
        var printWindow = window.open('', '', 'width="100%",height=800'); 
        printWindow.document.open();
        printWindow.document.write('<html><head><title>Print</title><style>table { width: 100%; border-collapse: collapse; } th, td { border: 1px solid black; padding: 8px; }</style></head><body>' + content + '</body></html>');
        printWindow.document.close();
        printWindow.print(); 
    });
</script>
@endsection
