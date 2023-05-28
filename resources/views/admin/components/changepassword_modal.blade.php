<div class="p-5">
  <form action="{{route('admin.forcecpvchangepass')}}" method="post">
    @csrf
    <label for="">New Password</label>
    <input type="password" name="newpass" id="newpass" class="form-control text mb-2">
    <input type="hidden" name="userID" value="{{$userID}}">
    <label for="">Reenter Password</label>
    <input type="password" id="repass" class="form-control text mb-2">
    <div class="form-check">
        <input class="form-check-input" type="checkbox"  style="cursor: pointer" value="" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault"  style="cursor: pointer">
            Show Password
        </label>
      </div>
    <button class=" px-3 py-2 w-100 mt-3 bg-secondary" disabled id="cpbtn">Change Password</button>
  </form>
</div>
{{-- customaddBtn --}}
<script>
    $(document).ready(function(){
        $('#flexCheckDefault').click(function(){
            if($(this).prop('checked') == true){
                $('.text').attr('type','text');
                $(this).prop('checked',true);
            }else {
                $('.text').attr('type','password');
            }
        })
        $('#repass').keyup(function(){
            var newpass = $('#newpass').val();

            if(newpass == $(this).val()){
                    $('#cpbtn').removeAttr('disabled').removeClass('bg-secondary').addClass('customaddBtn');
            }else {
                $('#cpbtn').attr('disabled',true).addClass('bg-secondary').removeClass('customaddBtn');
            }
        })

        $('#newpass').keyup(function(){
            var repass = $('#repass').val();

            if(repass == $(this).val()){
                    $('#cpbtn').removeAttr('disabled').removeClass('bg-secondary').addClass('customaddBtn');
            }else {
                $('#cpbtn').attr('disabled',true).addClass('bg-secondary').removeClass('customaddBtn');
            }
        })
        
    })
</script>