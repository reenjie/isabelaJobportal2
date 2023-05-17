
<table style="font-size:14px" class="table  table-striped" id="jobpost">
    <thead>
        <tr class="" style="text-transform:uppercase;font-weight:normal">
            <th scope="col">Position</th>
            <th scope="col">Plantilla No.</th>
            <th scope="col">Office</th>
            <th scope="col">Description</th>
            <th scope="col">Competencies</th>
            <th scope="col">Date Published</th>
            <th scope="col">Status</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody  >
        @if(count($data)>=1)
        @foreach ($data as $item)
<tr>
    <td>
        <span style="font-weight:bold">{{ $item->title }}</span>
        <br>
        <span>{{ $item->salary }} ( &#8369;{{ number_format($item->monthly_sal) }} )</span>
    </td>
    <td>{{ $item->plantilla_no }}</td>
    <td>
        @foreach ($offices as $office)
            @if($office->ID == $item->office_id)
             {{$office->Office}}
            @endif      
        @endforeach
    </td>
    <td>{{ $item->description }}</td>
    <td>{{ $item->competencies }}</td>
    <td>{{ date('F j Y', strtotime($item->date_posted)) }}</td>
    <td>
        @if ($item->status == 1)
        <span class="badge bg-success">Published</span>
        @else
           
            <span class="badge bg-warning">Unpublished</span>
        @endif
    </td>
    <td>
        <div class="btn-group">
            <button data-bs-toggle="modal" data-bs-target="#edit{{ $item->id }}"
                class="btn btn-light btn-sm text-primary"><i
                    class="fas fa-pen"></i></button>
            @include('components.modal', [
                'id' => 'edit' . $item->id,
                'modalsize' => 'modal-lg',
                'modaltitle' => 'Update Job Postings',
                'type' => 'UpdateJobPostings',
                'itemid' => $item->id,
                'data' => $item,
            ])
         
            @if ($item->status == 1)
              
            <button data-id="{{$item->id}}" class="btn btn-light text-danger btnunpublish  btn-sm"  name="publish"
            value="0" style="text-decoration:underline">UNPUBLISH</button>
                @else
                <button data-id="{{$item->id}}" class="btn btn-light text-success btnpublish btn-sm" name="publish"
                value="1" style="text-decoration:underline">PUBLISH</button>
                @endif
        </div>


    </td>
</tr>
@endforeach
@else 
    <tr>
        <td style="text-align:center" colspan="8">
          
            <lord-icon
            src="https://cdn.lordicon.com/zniqnylq.json"
            trigger="loop"
            delay="5000"
            style="width:100px;height:100px;">
           

        </lord-icon>
      <h6 style="font-weight: bold"> No Position Found</h6>
        </td>
    </tr>

    @endif
    </tbody>
</table>


<script>
  $(document).ready(function(){
    
    $('.btnunpublish').click(function(){
      
        var publish = $(this).val();
        var id = $(this).data('id');
        Action.Publish_Status(id , publish,function(response){
            if(response == 'success'){
                if($('#search').val()){
                    Fetch.getJobPost($('#search').val());
                    return;
                }
                Fetch.getJobPost();
            }
       });
    })
    $('.btnpublish').click(function(){
        var publish = $(this).val();
        var id = $(this).data('id');
       Action.Publish_Status(id , publish,function(response){
            if(response == 'success'){
                if($('#search').val()){
                    Fetch.getJobPost($('#search').val());
                    return;
                }
                Fetch.getJobPost();
            }
       });
      

    })

    $('#jobpost').on('destroy.dt', function() {
    $('.btnunpublish').off('click');
    $('.btnpublish').off('click');
    table.destroy();
});
  });
</script>