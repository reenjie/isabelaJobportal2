<div class="container">
    <form method="post" enctype="multipart/form-data" action="{{route('update.profile')}}">
        @csrf
        <input type="file" name="file" class="form-control" required accept="image/*">
        <button type="submit" class="btn btn-dark mt-3 form-control py-3">UPDATE</button>
    </form>
</div>