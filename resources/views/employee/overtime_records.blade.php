@extends('layouts.homeLayout',['pageTitle'=>"Overtime Records","active"=>"overtime_records"])

@section('content')
<div class="container-fluid">

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

    @isset($links)
    @if (count($links) >= 1)
    {{ $links->render('admin.components.pagination') }}
    @endif
    @endisset
</div>
@endsection