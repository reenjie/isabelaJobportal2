@extends('layouts.homeLayout', ['pageTitle' => 'Job Application', 'active' => 'jobapplication'])

@section('content')
    <div class="container-fluid mt-4">
        @include('components.alerts')
        <ul class="nav nav-tabs" id="myTab" role="tablist" style="font-size: 14px">
            <li class="nav-item" role="presentation">
                <a href="{{ route('admin.jobapplications') }}"
                    class="nav-link @if (!request('page')) active @endif">Applications <i
                        class="fas fa-list"></i></a>
            </li>
            <li class="nav-item" role="presentation">
                <a href="?page=InterviewSchedule" class="nav-link @if (request('page') == 'InterviewSchedule') active @endif">Interview
                    Schedules <i class="fas fa-calendar"></i></a>
            </li>
            <li class="nav-item" role="presentation">
                <a href="?page=Pre-Employees" class="nav-link  @if (request('page') == 'Pre-Employees') active @endif">Pre -
                    Employees <i class="fas fa-user-tie"></i></a>
            </li>

        </ul>
      
        @switch(request('page'))
            @case('InterviewSchedule')
                @include('admin.components.interviewsched')
            @break

            @case('Pre-Employees')
                @include('admin.components.preemployees')
            @break

            @default
                @include('admin.components.application')
        @endswitch

      
    </div>
   
@endsection
