<div class="">
    <div class="card-body">
        <div class="row mt-3">
            <div class="col-md-1 mb-2">
                <button class="customaddBtn px-2" onclick="window.location.reload()">Reload <i class="fas fa-sync"></i></button>
            </div>
            <div class="col-md-3 mb-2">
    <select name="" class="form-select " id="filterstatus">
        <option value="">Filter By:</option>
        <option value="">All</option>
        <option value="0">Not Qualified</option>
        <option value="1">Pending</option>
        <option value="2">For Interview</option>
        <option value="100">Hired</option>
        </select>                
            </div>
          
            <div class="col-md-4 mb-2">
                <select name="" class="form-select mb-2 " id="filterJobpost">
                    <option value="">Filter By Job Position</option>
                    <option value="">All</option>
                    @foreach ($AppliedJobpost as $item)
                        <option value="{{$item->id}}">{{$item->title}}  &middot; pt#{{$item->plantilla_no}}</option>
                    @endforeach
                    </select>   
            </div>
            <div class="col-md-4 mb-2">
                <div class="input-group flex-nowrap ">
                    <span class="input-group-text text-secondary" id="addon-wrapping"><i class="fas fa-search icons"></i></span>    
                    <input type="text" class="form-control  " style="text-transform:uppercase" id="search" autofocus placeholder="Search by Name" aria-label="Username"
                        aria-describedby="addon-wrapping">        
                           
                  </div>
            </div>
        </div>
      
        <div class="p-2 " id="applications_data">
            <div style="text-align:center;padding:150px">
                <div class="spinner-border justify-content-center" style="width: 3rem; height: 3rem;" role="status">
                  </div>
                  <br> 
                  <span style="font-size:14px;font-weight:bold">LOADING</span>
            </div> 
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        Fetch.getAllapplications();

        $('#search').keyup(function(){
            var jobpost = $('#filterJobpost').val();
            var status = $('#filterstatus').val();
            var search = $(this).val();
            Fetch.getAllapplications(search,status,jobpost);
        })

        $('#filterstatus').change(function(){
            var jobpost = $('#filterJobpost').val();
            var status = $(this).val();
            var search = $('#search').val();
            Fetch.getAllapplications(search,status,jobpost);
        })
        $('#filterJobpost').change(function(){
            var jobpost = $(this).val();
            var status = $('#filterstatus').val();
            var search = $('#search').val();
            Fetch.getAllapplications(search,status,jobpost);
        })
    })
</script>