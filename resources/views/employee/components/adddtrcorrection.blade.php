<form action="{{route('save.dtrCorrections')}}" method="POST">
    @csrf
    <div class="p-3">
        <h6>
            Date
        </h6>
        <input type="date" name="datedtr" required class="form-control mb-2 ">
        <h6>Note</h6>
        <textarea name="note" required class="form-control mb-1" id="" cols="30" rows="10"></textarea>
        
        <div style="display: flex;justify-content:flex-end">
            <button type="submit" class="customaddBtn px-5 mt-2 py-2 mb-3">Submit</button>
        </div>
    </div>
</form>