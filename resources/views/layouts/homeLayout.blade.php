<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Isabela LGU - HRMS</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('logo/loginlogo.png') }}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
    integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.css" rel="stylesheet" />
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor5/37.0.1/ckeditor.min.js" integrity="sha512-u1sLXXwUefvooLCurgZpkZnSlf4Q3DJ4hIzrpB4mXFdbKsGbcekHI1x2G+ZDSVPj1r2wGnW+takK8AcAVDlqfQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body>
    <div class="">
        <div class="topbar">

            <div class="titlebar">

                <button id="hidesidebar"> <i class="fas fa-bars"></i></button>
                <h5>PORTAL</h5>
            </div>

            <div class="userInfo" id="userclick">


                <h6>{{ Auth::user()->name }}</h6>
                <img src="https://th.bing.com/th/id/OIP.Crq9sn3Qu3HyHwPJi2zW8QHaHa?pid=ImgDet&rs=1" alt="">
                <input type="checkbox" id="nav" class="d-none">


            </div>



        </div>
        <div class="drop" id="drop">
            <div class="droplinks">
                <a href="{{route('myprofile')}}"><i class="fas fa-user-circle"></i><span>Profile</span></a>         
                <a href="javascript:void()" id="btnlogout"><i class="fas fa-power-off"></i> <span>Logout</span></a>
                <form action="{{ route('logout') }}" method="post"> @csrf
                    <button type="submit" class="d-none" id="logout"></button>
                </form>

            </div>
        </div>
        <div class="sidebar">
            <input type="checkbox" id="side" class="d-none">
            <div class="title">
                <img src="{{ asset('logo/loginlogo.png') }}" alt="">
                <h6>Isabela LGU</h6>

            </div>

            <div class="links">
                @if(session()->has('userRole'))
                @if(session()->get('userRole') == 7)
                <a href="{{ route('admin.dashboard') }}"
                    class="@if ($active == 'dashboard') activesidebar usernone @endif"><i
                        class="fas fa-dashboard"></i><span>Dashboard</span></a>
                <a href="{{ route('admin.jobpostings') }}"
                    class="@if ($active == 'jobpostings') activesidebar @endif"> <i
                        class="fas fa-suitcase"></i><span>Job Postings</span></a>
                <a href="{{ route('admin.jobapplications') }}"
                    class="@if ($active == 'jobapplication') activesidebar @endif"><i
                        class="fas fa-clipboard-list"></i><span>Job Applications 
                                @php
                                    $countofPendingApplications = DB::select('select * from applications where status = 1');
                                @endphp
                            @if ($active != 'jobapplication')
                            @if(count($countofPendingApplications)>=1)
                            <span
                            class="badge bg-danger">@if(count($countofPendingApplications)> 100) 99+ @else count($countofPendingApplications) @endif</span></span></a>
                            @endif
                            @endif
                <a href="{{ route('admin.announcements') }}"
                    class="@if ($active == 'announcement') activesidebar @endif"><i
                        class="fas fa-bell"></i><span>Announcements</span></a>
                <a href="{{ route('admin.reports') }}"
                    class="@if ($active == 'reports') activesidebar @endif"><i
                        class="fas fa-list"></i><span>Reports</span></a>
                <a href="{{ route('admin.users') }}" class="@if ($active == 'users') activesidebar @endif"><i
                        class="fas fa-users"></i><span>Users</span></a>
                <a href="{{ route('admin.auditlogs') }}"
                    class="@if ($active == 'auditlogs') activesidebar @endif"><i
                        class="fas fa-code"></i><span>Audit Logs</span></a>
                @else 
                <style>
                    #employeetabs{
                   
                        border-radius: 10px
                    }
                    #employeetabs a {
                        font-size: 12.8px;
                      
                        /* border-bottom:1px solid #526D82; */
                       
                    }
                </style>
                    <div style="padding:5px;height:70vh;overflow-y:scroll;" id="employeetabs">
                         <span style="font-size:10px;margin-left:10px;text-transform:uppercase" class="text-warning">REPORTS</span>
                        <a href="{{ route('admin.announcements') }}"
                    class="@if ($active == 'announcement') activesidebar @endif"><span>Dashboard</span></a> 

                         <span style="font-size:10px;margin-left:10px;text-transform:uppercase" class="text-warning">RECORDS</span>
                           <a href="{{ route('employee.personal_data') }}"
                    class="@if ($active == 'personal_data') activesidebar @endif"><span>Personal Data</span></a> 
                          <a href="{{ route('employee.service_records') }}"
                    class="@if ($active == 'service_records') activesidebar @endif"><span>Service Records</span></a> 
                          <a href="{{ route('employee.daily_time_records') }}"
                    class="@if ($active == 'daily_time_records') activesidebar @endif"><span>Daily Time Records</span></a> 
                          <a href="{{ route('employee.leave_credits') }}"
                    class="@if ($active == 'leave_credits') activesidebar @endif"><span>Leave Credits</span></a> 
                          {{-- <a href="{{ route('employee.loan_transaction_records') }}"
                    class="@if ($active == 'loan_transaction_records') activesidebar @endif"><span>Loan Transaction Records</span></a>  --}}
                          <a href="{{ route('employee.payslips') }}"
                    class="@if ($active == 'payslips') activesidebar @endif"><span>Payslips</span></a> 
                          {{-- <a href="{{ route('employee.overtime_records') }}"
                    class="@if ($active == 'overtime_records') activesidebar @endif"><span>Overtime Records</span></a> 
                          <a href="{{ route('employee.discipline_records') }}"
                    class="@if ($active == 'discipline_records') activesidebar @endif"><span>Discipline Records</span></a>  --}}
           <span style="font-size:10px;margin-left:10px;text-transform:uppercase" class="text-warning">MY ONLINE request</span>
            <a href="{{ route('employee.leave_application') }}"
                    class="@if ($active == 'leave_application') activesidebar @endif"><span>Leave Application</span></a> 
                     <a href="{{ route('employee.compensatory_timeoff') }}"
                    class="@if ($active == 'compensatory_timeoff') activesidebar @endif"><span>Compensatory Time-off</span></a> 
                     <a href="{{ route('employee.dtr_correction') }}"
                    class="@if ($active == 'dtr_correction') activesidebar @endif"><span>DTR Correction</span></a> 
                     <a href="{{ route('employee.monetization') }}"
                    class="@if ($active == 'monetization') activesidebar @endif"><span>Monetization</span></a> 
                     <a href="{{ route('employee.official_business_pass') }}"
                    class="@if ($active == 'official_business_pass') activesidebar @endif"><span>Official Business Pass</span></a> 
                     {{-- <a href="{{ route('employee.clearance') }}"
                    class="@if ($active == 'clearance') activesidebar @endif"><span>Clearance</span></a>  --}}
                    </div>
                @endif
             @endif
            </div>
            <div class="signature">
                <h6>v2.0</h6>
            </div>
        </div>
        <main class="main">

            <div class="container-fluid">
                <div class="container-fluid">
                    <div class="card mb-2 cardtitle" style=" border-left: 10px solid rgb(158, 179, 196);">
                        <div class="card-body">
                        
                            <h5 class="pageTitle">{{ $pageTitle }}
                             
                                <nav class="bread"
                                    style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                                    aria-label="breadcrumb">
                                    <ol class="breadcrumb" style="text-transform: lowercase">
                                        <li class="breadcrumb-item"><a href="/Dashboard"
                                                style="text-transform:capitalize;text-decoration:none;color:#3C486B">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item " aria-current="page">{{ $pageTitle }}</li>
                                    </ol>
                                    
                                </nav>
                            </h5>
                         
                         
                        </div>
                    </div>
                </div>
                @yield('content')
            </div>

        </main>

    </div>
    <h6 class="footer">ISABLE LGU @ 2023</h6>


</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="{{asset('js/fetch.js')}}"></script>
<script src="{{asset('js/action.js')}}"></script>
<script src="{{ asset('js/dashboard.js') }}"></script>

</html>
