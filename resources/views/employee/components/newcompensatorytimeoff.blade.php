<form action="{{route('save.newcompensatorytimeoff')}}" method="post">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <h6>Date</h6>
            <input type="date" required class="form-control mb-2" name="date">
            
        </div>
        <div class="col-md-6">
            <h6>Time In</h6>
            <input type="time" required class="form-control mb-2" name="timein">
        </div>
        <div class="col-md-6">
            <h6>Time Out</h6>
            <input type="time" required class="form-control mb-2" name="timeout">
        </div>
        <div class="col-md-12 mt-3">
            <h6>
                Additional Information
              
            </h6>
            <textarea name="addinfo" required class="form-control" placeholder="This will give the approver more information about the request" id="" cols="30" rows="10"></textarea>
        </div>
    </div>

    <div style="display: flex;justify-content:flex-end" class="mt-2 mb-1">
        <button type="submit" class="customaddBtn px-5 mt-5 py-2 mb-3">Submit</button>
    </div>

</form>