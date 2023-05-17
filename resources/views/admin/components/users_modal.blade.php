<form action="@isset($edit){{route('admin.updateusers')}}@else{{route('admin.addusers')}}@endif" method="post">
    @csrf
    
    @isset($edit)
    <input type="hidden" name="userID" value="{{$userID}}">
    @endisset
    <div class="row p-2">
        <div class="col-md-8 mb-2">
            <h6>Select Employee</h6>
    <input list="employee"  id="employee_search" required class="form-control" placeholder="Type to search for employee."
    @isset($edit)
    value="{{ preg_replace('/\s+/', ' ', trim($Fullname)) }}"
    disabled
    @endisset
    
    >
    <div class="datalist d-none">
        <input type="hidden" name="employeeID" id="dataValue">
        <div id="dataitems">
      @foreach ($employees as $item)
      <li class="datalistItems" data-id="{{$item->ID}}" data-email="{{$item->email}}" data-empno="{{$item->empno}}" data-name="{{$item->lastname.','.$item->firstname.' '.$item->midname.' ('.$item->empno.')'}}">{{$item->lastname.','.$item->firstname.' '.$item->midname.' ('.$item->empno.')'}}</li>
    @endforeach
</div>
        <div class="d-none" id="datalistnone">
            <lord-icon
            src="https://cdn.lordicon.com/zniqnylq.json"
            trigger="loop"
            delay="1500"
            style="width:100px;height:100px;">
        </lord-icon>
        <br>
            No Employee Data Found.
        </div>
      </div>
        </div>
        <div class="col-md-4 mb-2">
            <h6>Employee No.</h6>
            <input type="text" class="form-control"  id="empno"  name="empno"
            @isset($edit)
            value="{{$Employee_No}}"
            disabled
            @else 
            
            readonly
            @endisset
            
            >
        </div>
    
        <div class="col-md-12 mb-2">
            <h6>Email</h6>
            <input type="email" class="form-control" id="email" name="email"
            @isset($edit)
                value="{{$data['email']}}"
            @endisset required>
        </div>
        <div class="col-md-12 mb-2">
         
            <div class="card" style="z-index: 1">
                <div class="card-body">
                    <h6 style="">SPECIAL ROLES</h6>
                
                    <div class="row">
                        @foreach ($RoleSelection as $item)
                        <div class="col-md-6">
                            <div class="form-check" style="text-transform: uppercase;font-size:14px;color:#395597">
                                <input class="form-check-input selectedroles" name="selectedroles[]" type="checkbox"
                                @isset($edit)
                                        @foreach ($roles as $rl)
                                            @if($rl->entity_id == $data['id'])
                                                        @if($item->id == $rl->id)
                                                        checked
                                            @endif
                                            @endif
                                        @endforeach
                                     @endisset 
                                
                                value="{{$item->id}}" id="flexCheckDefault{{$item->id}}">
                                <label class="form-check-label" for="flexCheckDefault{{$item->id}}">
                                    {{$item->title}}
                                   </label>

                              </div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <button class="customaddBtn px-5 py-2 mt-3 @isset($edit) @else disabledbtn @endif" id="saveusersbtn"  style="float: right;">
                @isset($edit)
                Update
                @else
                Save
                @endisset
            </button>
        </div>
    </div>
</form>

