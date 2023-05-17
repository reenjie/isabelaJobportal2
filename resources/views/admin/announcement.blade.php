@extends('layouts.homeLayout',['pageTitle'=>"Announcements","active"=>"announcement"])

@section('content')
<div class="container-fluid">
   <div class="row">
    <div class="col-md-6">
        <div class="card shadow" id="cardupdate">
            <div class="card-body">
                <h6 class="fonttitle fw-bold text-secondary">Post Announcement <i class="fas fa-pen"></i></h6>
                <form action="{{route('save.announcement')}}" id="action" method="POST"> @csrf
                    <input type="hidden" name="id" id="anid">
                    <input type="hidden" name="typeofaction" id="typeofaction" value="add">
                    <h6>Title</h6>
                <input type="text" id="title" name="title" required autofocus class="form-control mb-2">
                <h6>Content</h6>
                <textarea name="content" id="content" required class="form-control" id="" cols="30" rows="5"></textarea>
                <button type="submit" id="btnpost" class="customaddBtn py-2  mt-3" style="width:100%">Post <i class="fas fa-paper-plane"></i></button>
                <button type="button" id="btncancel" onclick="window.location.reload()" style="border-radius: 15px" class="btn d-none btn-danger btn-sm mt-2 form-control" >Cancel</button>
            </form>
            </div>
        </div>
    </div>
    <div class="col-md-6 mt-4 mb-5">
        @if(count($all)>=1)
        <h4 class="fonttitle text-secondary">All Posted <i class="fas fa-list"></i> </h4>
  <div style="height:100vh;overflow-y:scroll;padding:4px">
    @foreach ($all as $item)
    <div class="card shadow mb-2 cardselected" id="cardselected{{$item->id}}" style="border-top:5px solid #F1D3B3">
        <div class="card-body">
            <span style="font-size:12px;float:right;color:grey">{{date("h:ia F j,Y",strtotime($item->created_at))}}</span>
            <h6 style="color:#243763;font-weight:bold;">{!!$item->title!!}</h6>
            <span style="font-size: 13px">{!!$item->content!!}</span>
            <button class="customaddBtn px-2 edit " data-item="{{$item}}" style="float: right;"><i class="fas fa-edit"></i></button>
        </div>
    </div>
@endforeach
  </div>
        @else 
        <div style="text-align:center;">
            <img src="{{asset('logo/pagenotfound.svg')}}" style="width: 200px" alt="">
            <h6 class="mt-3 fw-bold">No Announcement yet.</h6>
           </div>
    
        @endif
      
    </div>
    </div> 
</div>


@if (session()->has('success'))
<script>
    Toastify({
        text: "{{ session()->get('success') }}",
        duration: 10000,
        newWindow: true,
        close: true,
        gravity: "top",
        position: "right",
        stopOnFocus: true,
        style: {
            background: "#68B984",
            color: "white",
            borderRadius: "2px",
            paddingX: "40px",
            marginTop: "45px",
            fontWeight: "bold",
            fontSize: "13px"
        },
        onClick: function() {}
    }).showToast();
</script>
@endif

@endsection
