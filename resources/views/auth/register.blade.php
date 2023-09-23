@extends('layouts.homepage',["register"=> true , "activePage"=>'register'])

@section('content')
<main>
    <div class="container" id="registercard">
    <div class="card shadow p-2" style="z-index: 1" >
        <div class="card-body">
           

            @if(session()->has('otpSend'))
            @include('otp')
            @elseif(session()->has('redirecttoLogin'))
            @include('verified')
            @else
  <h5 class="mb-3">Register</h5>
            
            <form action="{{route('register')}}" method="POST">
                @csrf  
                <div class="row">
                <div class="col-md-4 mb-2">
                    <h6>First Name</h6>
                    <input type="text" class="form-control" required name="fname" value="{{old('fname')}}" required autofocus>
                </div>
                <div class="col-md-4 mb-2">
                    <h6>Middle Name</h6>
                    <input type="text" class="form-control" required name="mname" value="{{old('mname')}}" required>
                </div>
                <div class="col-md-4 mb-2">
                    <h6>Last Name</h6>
                    <input type="text" class="form-control" required name="lname" value="{{old('lname')}}" required>
                </div>
        
                <div class="col-md-6 mb-2">
                    <h6>Birth Date</h6>
                    <input type="date" class="form-control" required name="bdate" max="{{date('Y-m-d')}}" value="{{old('bdate')}}" required>
                </div>
                <div class="col-md-6 mb-2">
                    <h6>Sex</h6>
                   <select name="gender" required class="form-select" id="" value="{{old('gender')}}" required>
                    <option value="">-- Select Sex --</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                   </select>
                </div>
        
                <div class="col-md-6 mb-2">
                    <h6>Mobile</h6>
                    <input type="text" required class="form-control" name="mobile" value="{{old('mobile')}}" required>
                </div>
                <div class="col-md-6 mb-2"></div>
                <div class="col-md-12 mb-2">
                    <h6>Email</h6>
                    <input type="email" required class="form-control @error('email') is-invalid @enderror" name="email" required>
                    <div style="font-size:13px" class="invalid-feedback">
                        {{$errors->first('email')}}
                    </div>
                </div>
        
                <div class="col-md-6 mb-2">
                    <h6>Password</h6>
                    <input type="password" required class="form-control passv" id="pass" name="password" required>
                    <div id="restrict" class="d-none">
                      <div class="card">
                        <div class="card-body">
        <h6 style="font-size:10px;text-transform:uppercase"> Your Password should contain the following :</h6>
          
          
                            <ul style="font-size:13px;color:rgb(156, 68, 68)">
                                <li id="eight">Must be atleast 8 Characters</li> 
                                <li id="uppercase">Must contain at least one UPPERCASE letter</li>
                                <li id="lowercase">Must contain at least one lowercase letter</li>
                                <li id="number">Must contain at least one number /1-9/ </li>
                             
                            </ul>
                        </div>
                      </div>
                    </div>
                </div>
        
                <div class="col-md-6 mb-2">
                    <h6>Confirm Password</h6>
                    <input type="password" disabled required class="form-control passv" id="repass" name="repass" required>
                    <div  id="feedback" >    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault" style="font-size:14px;font-weight:Bold">
                          SHOW PASSWORD
                        </label>
                      </div>
                </div>
                
                <div class="col-md-12">
                    <button  class="customaddBtn px-5 py-2 disabled" id="signup" style="float: right;" >SIGN UP</button>
                </div>
            </div>
            </form>
          

          
       
       
       
       
      
            @endif
        </div>
    </div>
    </div>
</main>


<script>
    $('#signup').click(function(){
   $(this).addClass('disabled');
   $(this).html('<div class="spinner-border  spinner-border-sm" role="status"><span class="visually-hidden">Loading...</span></div>');
})
    $('#pass').keyup(function(){
        var password = $(this).val();
        if(password == ''){
            $('#restrict').addClass('d-none');
            $('#repass').attr('disabled',true);
            $('#repass').val('');
            $('#feedback').html('');
        }else {
   $('#restrict').removeClass('d-none');
    // Password must be at least 8 characters long
    if (password.length < 8) {
    $('#eight').removeClass('d-none');
    } else {
     $('#eight').addClass('d-none');
    }

    // Password must contain at least one uppercase letter
    if (!/[A-Z]/.test(password)) {
     $('#uppercase').removeClass('d-none');
    } else {
        $('#uppercase').addClass('d-none');
    }

     // Password must contain at least one lowercase letter
     if (!/[a-z]/.test(password)) {
     $('#lowercase').removeClass('d-none');
    } else {
        $('#lowercase').addClass('d-none');
    }

    // Password must contain at least one number
    if (!/\d/.test(password)) {
    $('#number').removeClass('d-none');
    } else {
        $('#number').addClass('d-none');
    }

    if ($("#eight").hasClass("d-none") && 
    $("#uppercase").hasClass("d-none") && 
    $("#lowercase").hasClass("d-none") && 
    $("#number").hasClass("d-none") ) {
        $('#restrict').addClass('d-none');
        $('#repass').removeAttr('disabled'); 
    } 

    }

    })
    $('#repass').keyup(function(){
        var pass = $('#pass').val();
        var value = $(this).val();
        if(pass == value ){
            $('#signup').removeClass('disabled');
            $('#feedback').html(' <span style="font-size:12px;color:green">Password Match <i class="fas fa-check-circle"></i></span>');
        }else {
            $('#signup').addClass('disabled');
            $('#feedback').html(' <span style="font-size:12px;color:maroon">Password does not match <i class="fas fa-times-circle"></i></span>');
        }
    })
    $('#flexCheckDefault').click(function(){
        if($(this).prop('checked') == true){
            $('.passv').attr('type','text');
        }else {
            $('.passv').attr('type','password');
        }
    })
</script>
@endsection
