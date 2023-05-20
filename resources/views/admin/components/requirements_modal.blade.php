<div class="container">
    <div class="row">
        @foreach ($reqs as $item)
           <div class="col-md-12">
            <div class="card shadow mb-2">
                <div class="card-body">
                    {{$item->name}}
                    <br>
                    <span style="font-size:10px" class="text-secondary">{{date('h:i F j,Y',strtotime($item->date_created))}}</span>
                    <span style="float: right;" class="text-secondary"><i class="fas fa-file"></i></span>
                    <br>
                    <button class="mt-3 border-primary btn btn-light text-primary btn-sm px-3" 
                        onclick="window.open('http://51.79.158.240/server/storage/files/{{$item->file}}', '_blank')"
                    style="float: right">View</button>
               
                </div>
            </div>
           </div>
        @endforeach
    </div>
</div>