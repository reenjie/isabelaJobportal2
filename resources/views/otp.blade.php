<div class="container p-5">
    <h5>
        We have successfully sent an OTP ( one time pin ) Code to your Email.
    </h5>
    <span style="font-size:13px">Kindly fill in the code below to validate your account</span>
    <div class="row mb-4">
        <div class="col-md-5">
            <input type="text" class="form-control mt-3" id="otpCode" placeholder="OTP CODE" style="text-align: center" autofocus>
        </div>
    </div>

    <span style="font-size:12px">Didnt Get the Code ?</span>
    <form action="{{route('mail.sendOTP')}}">
        <button class="btn btn-primary btn-sm" id="resend">Resend OTP</button>
    </form>
</div>

<script>
$('#resend').click(function(){
   $(this).addClass('disabled');
   $(this).html('<div class="spinner-border  spinner-border-sm" role="status"><span class="visually-hidden">Loading...</span></div>');
})
$('#otpCode').keyup(function(){
    var val = $(this).val();

    if(val.length == 6){
       Action.ValidateOTP(val,function(res){
        if(res.message == 'failed'){
            $('#otpCode').addClass('is-invalid');
           
        }
       if(res.message == 'success'){
        $('#otpCode').addClass('is-valid');
        setTimeout(() => {
            location.reload();
        }, 2000);
       }
       });
    }
    if(val.length >=6){
        $('#otpCode').addClass('is-invalid');
    
    }

    $('#otpCode').removeClass('is-invalid');
  
  
});
</script>