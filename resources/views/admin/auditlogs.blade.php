@extends('layouts.homeLayout',['pageTitle'=>"Audit Logs","active"=>"auditlogs"])

@section('content')
<div class="container-fluid">
    <table class="table table-striped table-sm mt-4 text-center table-dark">
        <thead>
          <tr>
            <th scope="col">User</th>
            <th scope="col">Action</th>
            <th scope="col">DateTime</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $item)
                <tr>
                  
                    <td>
                        @foreach ($user as $ui)
                            @if($ui->id == $item->causer_id)
                        {{$ui->email}}
                            @endif
                        @endforeach
                    </td>
                    <td>{{$item->description}}</td>
                    <td>
                        {{date('@h:i a F j,Y',strtotime($item->created_at))}}
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>
    @isset($links)
        @if (count($links) >= 1)
            {{ $links->render('admin.components.pagination') }}
        @endif
    @endisset
</div>
@endsection
