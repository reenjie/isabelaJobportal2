@extends('layouts.homepage',["register"=> false , "activePage"=>'opportunities'])

@section('content')
    
  @if(session()->has('success'))
 <script>
     swal({
                        title: "Submitted!",
                        text: "Position Applied was submitted successfully!",
                        icon: "success",
                    });
 </script>
 @elseif(session()->has('exist'))
 <script>
    swal({
                       title: "Already exist",
                       text: "You have already submitted an application for this position",
                       icon: "info",
                   });
</script>

  @endif
  <main>
   <div class="row">
    <div class="col-md-6"></div>
    <div class="col-md-2"></div>
    <div class="col-md-4">
        <h6 id="search" style="font-weight:bold">Search for Positions</h6>
      
       <div class="d-flex">
     
        <input type="text" required name="search" id="searchkey" class="form-control form-control-md mb-2" placeholder="start typing here..">
        <button type="submit" class="customaddBtn " id="btnsearch"><i class="fas fa-search"></i></button>
 
       </div>
  
    </div>
   </div>
   <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Serif:opsz,wght@8..144,500&display=swap" rel="stylesheet">
    <h1 style="font-family: 'Roboto Serif', serif;color:#2E4374" >All Open Positions</h1>
   
    <div class="d-none" id="pos" style="text-align:center">
    <lord-icon
        src="https://cdn.lordicon.com/zniqnylq.json"
        trigger="loop"
        delay="600"
        style="width:300px;height:300px;text-align:center">
    </lord-icon>
    <h5 id="nopos">No Position Found <br/>
        <span style="font-weight:normal" class="text-danger" id="nosearchkey"></span>
    </h5>
    </div>
  @foreach ($jobpost as $item)
    <div class="jobcard shadow mb-1  " style="z-index:-1">
        <div class="card-body">
            <form action="{{route('viewItem')}}" method="post">
                @csrf
                <input type="hidden" name="jobid" value="{{$item->id}}">
                <button type="submit" class="customaddBtn  selectpos" data-id="{{$item->id}}"   style="float:right"><i class="fas fa-arrow-right"></i></button>
         </form>
         
            <h5><span class="jobtitle">{{$item->position}}</span> <br>
                
                <span style="font-size: 14px">{{$item->office}}</span>
                <br>
                <span style="font-size: 14px;">Published | {{date('F j,Y',strtotime($item->date_posted))}}</span>
                <br>
                <span style="font-size: 14px;color:grey">{{$item->description}}</span>
            </h5>
            
          
          
        </div>
    </div> 
    @endforeach 
    
  </main>


<script>
    $('.selectpos').click(function(){
        var id = $(this).data('id');
        localStorage.setItem('select_position',id);
    })
</script>
@endsection