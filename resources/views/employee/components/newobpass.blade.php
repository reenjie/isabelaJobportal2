<form action="{{route('save.newobpass')}}" method="post">
    @csrf

    <div class="p-3">
        <div class="row">
            <div class="col-md-12">
                <h6>Date</h6>
                <input type="date" class="form-control mb-2" required name="datebp">
            </div>
            <div class="col-md-6">
                <h6>Time of Departure</h6>
                <input type="time" class="form-control mb-2" required name="timeofdeparture">
            </div>
            <div class="col-md-6">
                <h6>Time of Return</h6>
                <input type="time" class="form-control mb-2" required name="timeofreturn">
            </div>
    
            <div class="col-md-12">
                <h6>Purpose</h6>
              <textarea name="purpose" class="form-control" required id="" cols="30" rows="10"></textarea>
            </div>
        </div>
    
        <div style="display: flex;justify-content:flex-end" class="mt-2 mb-1">
            <button type="submit" class="customaddBtn px-5 mt-2 py-2 mb-3">Submit</button>
        </div>
    </div>
</form>

