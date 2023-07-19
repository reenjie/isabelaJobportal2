@extends('layouts.homeLayout',['pageTitle'=>"Clearance","active"=>"clearance"])

@section('content')
<div class="container-fluid">

    @include('components.alerts')
    <style>
        table thead tr th {
            font-size: 13px;
            font-weight: normal
        }
    </style>

    <button class="customaddBtn px-5  py-2" data-bs-toggle="modal" data-bs-target="#newclearance">Create Clearance <i class="fas fa-plus-circle"></i></button>
    @include('components.modal', [
    'id' => 'newclearance',
    'modalsize' => 'modal-lg',
    'modaltitle' => 'Create Clearance',
    'type' => 'newclearance',
    ])
    <div class="table-responsive p-3">
        <table class="table table-striped ">
            <thead>
                <tr class="table-primary" style="text-transform:uppercase;">

                    <th scope="col">Effective Date</th>
                    <th scope="col">Note</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @if(count($data)>=1)
                @foreach ($data as $item)
                <tr>
                    <td>{{date('F j, Y',strtotime($item->date_effective))}}</td>
                    <td>{{$item->note}}</td>
                    <td>
                        <div class="card text-center">
                            <div class="card-body">

                                @switch($item->status)
                                @case(-1)
                                <i class="fas fa-ban text-danger" style="font-size: 30px"></i>
                                @break
                                @case(0)
                                <i class="fas fa-ban text-secondary" style="font-size: 30px"></i>
                                @break
                                @case(1)

                                <span style="font-size:12px">
                                    For Departments Head Approval <i class="fas fa-info-circle"></i>
                                </span>
                                <br> <br>
                                <form action="{{route('cancel.Requestclearance')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="ID" value="{{$item->id}}">
                                    <button style="font-size:12px" class="btn btn-light btn-sm text-danger">CANCEL</button>
                                </form>

                                @break
                                @case(11)
                                <span style="font-size:12px">
                                    For Departments Head Approval <i class="fas fa-info-circle"></i>
                                </span>
                                <br> <br>
                                <form action="{{route('cancel.Requestclearance')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="ID" value="{{$item->id}}">
                                    <button style="font-size:12px" class="btn btn-light btn-sm text-danger">CANCEL</button>
                                </form>
                                @break
                                @case(12)
                                {{-- Pending HR --}}
                                <span style="font-size:12px">
                                    For HRMO's Approval <i class="fas fa-info-circle"></i>
                                </span>
                                @break
                                @case(13)
                                {{-- Pending Mayor --}}
                                <span style="font-size:12px">
                                    For Mayor's Approval <i class="fas fa-info-circle"></i>
                                </span>

                                @break
                                @case(2)
                                {{-- Approved --}}
                                <i class="fas fa-check-circle text-success" style="font-size: 30px"></i>
                                @break


                                @endswitch

                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td style="text-align:center" colspan="6">

                        <lord-icon src="https://cdn.lordicon.com/zniqnylq.json" trigger="loop" delay="5000" style="width:100px;height:100px;">

                        </lord-icon>
                        <h6 style="font-weight: bold"> No Data Found</h6>
                    </td>
                </tr>
                @endif
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