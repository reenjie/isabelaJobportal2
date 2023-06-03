@extends('layouts.homeLayout',['pageTitle'=>"Service Records","active"=>"service_records"])

@section('content')
<div class="container-fluid">
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
 
    @isset($links)
    @if (count($links) >= 1)
        {{ $links->render('admin.components.pagination') }}
    @endif
@endisset
</div>
@endsection
