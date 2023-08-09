@extends('layouts.homeLayout',['pageTitle'=>"Service Records","active"=>"service_records"])

@section('content')
<div class="container-fluid">
    @if(count($data)>=1)
    <style>
        table thead tr th {
            font-size:13px;
            font-weight: normal
        }
    </style>
    <div class="table-responsive p-3">
        <table class="table table-striped ">
            <thead>
              <tr class="table-primary" style="text-transform:uppercase;">
                <th scope="col">Date from</th>
                <th scope="col">Date to</th>
                <th scope="col">Designation</th>
                <th scope="col">Office</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>
                            {{$item->datefrom}}
                        </td>
                        <td>{{$item->dateto}}</td>
                        <td>{{$item->desig}}</td>
                        <td>{{$item->office_name}}</td>
                        <td>{{$item->status_}}</td>
                    </tr>
                @endforeach
            </tbody>
          </table>
    
    </div>

    @else 
    <div style="text-align: center;pointer-events:none;user-select:none" class="mt-5">
        <img src="https://th.bing.com/th/id/OIP.mexosehXrciNRvS4NohrwAAAAA?pid=ImgDet&rs=1" alt="" style="margin-top:50px">
        <br> <br>

      <h5 style="color:gray">  No Service records Found..</h5>
    </div>
    @endif
    @isset($links)
    @if (count($links) >= 1)
        {{ $links->render('admin.components.pagination') }}
    @endif
@endisset
</div>
@endsection
