@extends('layouts.homeLayout',['pageTitle'=>"My Profile", "active"=>""])

@section('content')
@include('components.alerts')
<div class="container-fluid ">
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body">
                    <h6 class="text-secondary">BASIC INFORMATION</h6>
                    <h6 style="text-align: center">
                        @php
                        if(Auth::user()->emp_id){
                        $photo = DB::select('SELECT * FROM `profilepicture` where emp_id ='.Auth::user()->emp_id);
                    }else {
                        $photo = [];
                    }
                        @endphp

                        @if(count($photo))
                        <img src="{{  asset('uploads/'.$photo[0]->photo) }}" width="200" class="rounded mb-3" alt="">
                        @else
                        <img src="https://th.bing.com/th/id/R.ab01b0e99e6089d02c0957dafe4decba?rik=wKS4tLyfLP65SQ&riu=http%3a%2f%2fwww.newdesignfile.com%2fpostpic%2f2010%2f04%2femployee-icon_150781.jpg&ehk=sEVxAvyCDU7q5Sku99HeyE6JioZb1Dvl%2fMFft1DEGNM%3d&risl=&pid=ImgRaw&r=0" width="200" class="rounded mb-3" alt="">
                        @endif

                        <br>

                        @if(count($data)>=1)
                        <span style="font-weight: bold"> {{$data[0]->lastname.' '.$data[0]->firstname.' '.$data[0]->midname}}</span>
                        <br>


                        @endif
                        <span>{{Auth::user()->email}}</span>
                        <br>
                        @if( Auth::user()->emp_id)
                        <button class="btn btn-primary btn-sm mt-3" data-bs-toggle="modal" data-bs-target="#changePP">Change Profile Picture <i class="fas fa-edit"></i></button>
                        @endif
                        @include('components.modal', [
                        'id' => 'changePP',
                        'modalsize' => '',
                        'modaltitle' => 'Change Profile Picture',
                        'type' => 'changePP',
                        ])
                    </h6>

                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body">
                    <h6 class="text-secondary">Change Password</h6>
                    <div class="p-5">
                        <form action="{{route('admin.forcecpvchangepass')}}" method="post">
                            @csrf
                            <label for="">New Password</label>
                            <input type="password" name="newpass" id="newpass" class="form-control text mb-2">
                            <input type="hidden" name="userID" value="{{Auth::user()->id}}">
                            <label for="">Reenter Password</label>
                            <input type="password" id="repass" class="form-control text mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" style="cursor: pointer" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault" style="cursor: pointer">
                                    Show Password
                                </label>
                            </div>
                            <button class=" px-3 py-2 w-100 mt-3 bg-secondary" disabled id="cpbtn">Change Password</button>
                        </form>
                    </div>
                    {{-- customaddBtn --}}
                    <script>
                        $(document).ready(function() {
                            $('#flexCheckDefault').click(function() {
                                if ($(this).prop('checked') == true) {
                                    $('.text').attr('type', 'text');
                                    $(this).prop('checked', true);
                                } else {
                                    $('.text').attr('type', 'password');
                                }
                            })
                            $('#repass').keyup(function() {
                                var newpass = $('#newpass').val();

                                if (newpass == $(this).val()) {
                                    $('#cpbtn').removeAttr('disabled').removeClass('bg-secondary').addClass('customaddBtn');
                                } else {
                                    $('#cpbtn').attr('disabled', true).addClass('bg-secondary').removeClass('customaddBtn');
                                }
                            })

                            $('#newpass').keyup(function() {
                                var repass = $('#repass').val();

                                if (repass == $(this).val()) {
                                    $('#cpbtn').removeAttr('disabled').removeClass('bg-secondary').addClass('customaddBtn');
                                } else {
                                    $('#cpbtn').attr('disabled', true).addClass('bg-secondary').removeClass('customaddBtn');
                                }
                            })

                        })
                    </script>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection