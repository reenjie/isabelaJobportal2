<form method="POST" id="submitinterview" action="{{route('admin.setInterview')}}">
    @csrf
<div class="container-fluid p-3">
    <h6 class="text-primary" style="text-transform: uppercase;font-weight:bold">{{ $jobtitle }}</h6>

    <hr>


    <div class="row">
        <div class="col-md-7 mb-2">
            <h6>Date</h6>
            <input type="date" min="{{date('Y-m-d')}}"  name="dateofInterview" required  class="form-control">
        </div>

        <div class="col-md-5 mb-2">
            <h6>Time</h6>
            <input type="time" name="timeofInterview" required class="form-control">
        </div>


        <div class="col-md-12 mb-2" >
            <h6>Venue</h6>
            <input type="text" name="venue" required class="form-control">
        </div>


        <div class="col-md-12 mb-2">
            <h6>HRMPSB</h6>
            <div class="alert alert-danger  d-none" id="errorcode">
                Please select one or more Interviewer to proceed.
             
            </div>
            <div class="row">
                @foreach ($hrmpsb as $item)
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="selectedInterviewer[]" value="{{ $item->ID }}"
                                id="flexCheckDefault{{ $item->ID }}">
                            <label class="form-check-label" for="flexCheckDefault{{ $item->ID }}">
                                {{ $item->firstname . ' ' . $item->midname . ' ' . $item->lastname }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

        <div class="col-md-12 mb-2">
            <h6>Note</h6>
            <textarea name="notes" class="form-control" id="" cols="30" rows="10"></textarea>
        </div>
     
        <div class="mt-4" style="display: flex;justify-content:flex-end">
            <button type="submit"  class="customaddBtn px-4 py-2">Set Interview</button>
        </div>
    </div>

</div>

</form>
<script>
    $('#submitinterview').on('submit',function(e){
        if ($('input[name="selectedInterviewer[]"]:checked').length === 0) {
        e.preventDefault(); // Prevent form submission
       $('#errorcode').removeClass('d-none');
    }
})
</script>

