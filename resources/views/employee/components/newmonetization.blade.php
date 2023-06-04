<form action="{{route('save.newmonetization')}}" method="post">
    @csrf
    @if($leaveCredits)
<h6>
    Vacation Leave : {{$leaveCredits[0]->vacay_lv}}
    <br>
    Sick Leave : {{$leaveCredits[0]->sick_lv}}
</h6>
@endif
<h6 class="mt-3">No of Days to be Monetized</h6>
<input type="number" name="noofdays" required min="1" class="form-control mb-2">
<h6>Additional Information</h6>
<textarea name="addinfo" class="form-control" id="" required cols="30" rows="10"></textarea>

<div style="display: flex;justify-content:flex-end">
    <button type="submit" class="customaddBtn px-5 mt-5 py-2 mb-3">Submit</button>
</div>

</form>