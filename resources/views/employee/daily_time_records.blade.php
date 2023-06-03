@extends('layouts.homeLayout',['pageTitle'=>"Daily Time Records","active"=>"daily_time_records"])

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
                <th scope="col">Date</th>
                <th scope="col">Log Time</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                  <tr>
                    <td>
                        {{$item->dat}}
                    </td>
                    <td>
                        {{$item->out_am}}
                    </td>
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
