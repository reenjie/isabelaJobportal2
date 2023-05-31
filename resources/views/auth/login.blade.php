@extends('layouts.app')
@section('content')
    <div class="loginCard">
        @if (session()->has('countingError'))
            @php
                $ml = session()->get('countingError');
                $addtime = '';
                
                // Prevent User from logging in if 3 or more failure login attemps
                if ($ml == $data['FirstOffensecount']) {
                    $addtime = $data['FirstOffense'];
                } elseif ($ml == $data['SecondOffensecount']) {
                    $addtime = $data['SecondOffense'];
                } elseif ($ml >= $data['ThirdOffensecount']) {
                    $addtime = $data['ThirdOffense'];
                }
                $time = date('M j, Y  H:i:s', strtotime($addtime, strtotime(session()->get('timer'))));
            @endphp
        @else
            @php
                $ml = '';
            @endphp
        @endif


        @if(session()->has('userBlocked'))
                <script>
              swal({
                title: "Account Blocked",
                text: "Your account has been blocked, Please Contact HRMO",
                icon: "error",
            });
                </script>
        @endif
        <div class="loginTitle">
            <img src="{{ asset('logo/loginlogo.png') }}" alt="">
            <h5>Sign in </h5>
        </div>
       
                <form action="{{route('signin')}}" method="post"> @csrf
                    <div class="logininputs">
                        
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text" id="addon-wrapping"><i class="fas fa-user icons"></i></span>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" autofocus placeholder="Username/Email Address" aria-label="Username"
                                aria-describedby="addon-wrapping">                
                          </div>
                          @error('email')
                          <span class="feedback" role="alert">
                             {{ $message }}
                          </span>
                      @enderror
               
                        <div class="input-group flex-nowrap mt-3">
                            <span class="input-group-text" id="addon-wrapping"><i class="fas fa-lock icons"></i></span>
                            <input type="password" class="form-control  @error('password') is-invalid @enderror" name="password"  placeholder="Password" aria-label="Username"
                                aria-describedby="addon-wrapping">
                        </div>
            
                       <div class="remember">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                       </div>
                    </div>
            
                        <div class="btnspace">
                          
                            <h6 style="font-size:15px;font-weight:bold" class="text-danger" id="demo"></h6>
                            @if($ml >= $data['FirstOffensecount'])
                         
                            <button type="submit" disabled class="slide_left btnlogin" > Login</button>
                            <script>
                                $('.btnlogin').attr('disabled',true).attr('style','background-color:grey').removeClass('slide_left');
                            </script>
                            @else
                            <button type="submit" class="slide_left btnlogin"> Login</button>
                            @endif
                           
                            
                         
                        </div>
                    
                        <div class="signature">
                            <h6>Isabela LGU | Portal-Login
                                <br>
                                <span>version 2.0</span>
                
                            </h6>
                
                        </div>
                    </form>



    </div>

    @isset($time)
        <script>
            var countDownDate = new Date("{{ $time }}").getTime();
            var x = setInterval(function() {
                var now = new Date().getTime();
                var distance = countDownDate - now;
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                document.getElementById("demo").innerHTML ="Time Remaining : " + minutes + "M: " + seconds + "S";
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("demo").innerHTML = "";
                    $('#loginUI').removeClass('d-none');
                    $('#LockInterface').addClass('d-none');
                    $('.btnlogin').removeAttr('disabled',true).removeAttr('style').addClass('slide_left');
                }
            }, 1000);
            
        </script>
    @endisset
    @if (session()->has('disabled'))
        <script>
            $('.btnlogin').attr('disabled',true).attr('style','background-color:grey').removeClass('slide_left');
            swal({
                title: "Login Disabled",
                text: "You are disabled for multiple login Failures.",
                icon: "error",
            });
        </script>
    @endif
@endsection
