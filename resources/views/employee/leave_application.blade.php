@extends('layouts.homeLayout',['pageTitle'=>"Leave Application","active"=>"leave_application"])

@section('content')
<div class="container-fluid">
    @include('components.alerts')
    <button class="customaddBtn px-5 mb-2 py-2" data-bs-toggle="modal" data-bs-target="#newleave">New Leave application <i class="fas fa-plus-circle"></i></button>
    @include('components.modal', [
        'id' => 'newleave',
        'modalsize' => 'modal-lg',
        'modaltitle' => 'New Leave Application',
        'type' => 'addNewleaveApp',
    ])
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr class="table-primary">
                <th>Leave Type</th>
                <th>Application Date</th>
                <th># of Days</th>
                <th>Leave Dates</th>
                <th>Status</th>
                <th>Remarks</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{$item->leave_type}}</td>
                    <td>{{date('@h:ia F j,Y',strtotime($item->created_at))}}</td>
                    <td>{{$item->no_of_days}}</td>
                    <td>
                        <a href="{{route('View.Dates',['datescovered'=>$item->dates_covered,'leavetype'=>$item->leave_type])}}" target="_blank">View</a>
                       

                        
                    </td>
                    <td>
                        @switch($item->status)
                            @case(-1)
                                   {{-- Cancelled --}}
                                   <span class="badge bg-danger">Cancelled</span>
                                @break
                                @case(0)
                                   {{-- DENIED--}}
                                   <span class="badge bg-danger">Disapproved</span>
                                @break
                                @case(1)
                              
                                 <span class="badge bg-warning">Pending</span>
                             @break
                                @case(11)
                                   {{-- Pending HEAD --}}
                                   <span class="badge bg-warning">Pending</span>
                                @break
                            @case(12)
                                   {{-- Pending HR --}}
                                   <span class="badge bg-warning">Pending</span>
                                @break
                                @case(13)
                                       {{-- Pending Mayor --}}
                                       <span class="badge bg-warning">Pending</span>
                                @break
                                @case(2)
                                {{-- Approved --}}
                                <span class="badge bg-success">Approved</span>
                                @break
                           
                                
                        @endswitch
                    </td>
                    <td>
                        {{$item->remark}}
                    </td>
                    <td>
                        <div class="card text-center">
                            <div class="card-body">
                                
                                @switch($item->status)
                                @case(-1)
                                <i class="fas fa-ban text-danger" style="font-size: 30px"></i>
                                @break
                                @case(0)
                                <i class="fas fa-ban text-danger" style="font-size: 30px"></i>
                                @break
                                    @case(1)
                                  
                                  <span style="font-size:12px">
                                    For Departments Head Approval <i class="fas fa-info-circle"></i>
                                </span>
                                <br> <br>
                                <form action="{{route('cancel.Request')}}" method="post">
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
                                    <form action="{{route('cancel.Request')}}" method="post">
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
