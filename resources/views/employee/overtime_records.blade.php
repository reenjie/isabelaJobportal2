@extends('layouts.homeLayout',['pageTitle'=>"Overtime Records","active"=>"overtime_records"])

@section('content')
<div class="container-fluid">
@if(count($data)>=1)
    <div class="table-responsive p-3">
        <table class="table table-striped ">
            <thead>
                <tr class="table-primary" style="text-transform:uppercase;">
                    <th scope="col">Date</th>
                    <th scope="col">Overtime Records</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>
                        {{$item->dt}}
                    </td>
                    <td>
                        {{$item->total_overtime}}
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    @else 

    <div style="text-align: center;pointer-events:none;user-select:none" class="mt-5">
        <img src="https://th.bing.com/th/id/OIP.mexosehXrciNRvS4NohrwAAAAA?pid=ImgDet&rs=1" alt="" style="margin-top:50px">
        <br> <br>

      <h5 style="color:gray">  No Overtime Records Found..</h5>
    </div>

    @endif
    @isset($links)
    @if (count($links) >= 1)
    {{ $links->render('admin.components.pagination') }}
    @endif
    @endisset
</div>
@endsection