@extends('layouts.homeLayout',['pageTitle'=>"Leave Credits","active"=>"leave_credits"])

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
                <th scope="col">Sick Leave</th>
                <th scope="col">Vacation Leave</th>
                <th scope="col">Total Leaves</th>
                <th scope="col">Terminal Leave Benefits</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                @php
                    $totalleaves = $item->sick_lv + $item->vacay_lv;
                    $terminal_leaves = $totalleaves;
                @endphp
                <tr>
                    <td>{{$item->sick_lv}}</td>
                    <td>{{$item->vacay_lv}}</td>
                    <td>{{$totalleaves}}</td>
                    <td>{{round($salary * $totalleaves * 0.0481927 , 2)}}</td>
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
