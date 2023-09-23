<div class="container p-5">
    <h5>
        We have successfully Verified your account <i class="fas fa-check-circle text-success"></i>
    </h5>
    <a href="{{route('login')}}">Proceed to Login</a>
   
</div>
@php
    session()->forget('redirecttoLogin');
@endphp
