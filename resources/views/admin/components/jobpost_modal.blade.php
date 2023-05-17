<form action="@isset($edit){{ route('edit.jobpost') }}@else{{ route('save.jobpost') }}@endisset" method="post">
    @csrf
    @isset($edit)
    <input type="hidden" name="id" value="{{$data['id']}}">
    @endisset
    <div class="row">
        <div class="col-md-8 mb-2">
            <h6>Position</h6>
            <input type="text" name="position"
                value="@isset($edit){{ $data['title'] }}@endisset" required
                class="form-control form-control-sm">
        </div>
        <div class="col-md-4 mb-2">
            <h6>Post-Date</h6>
            <input type="date" name="postdate"
                value="@isset($edit){{ $data['date_posted'] }}@else{{date('Y-m-d')}}@endisset" required
                value="{{ date('Y-m-d') }}" class="form-control form-control-sm">
        </div>

        <div class="col-md-6 mb-2">
            <h6>Plantilla No.</h6>
            <input type="text" name="plantilla"
                value="@isset($edit){{ $data['plantilla_no'] }}@endisset" required
                class="form-control form-control-sm">
        </div>
        <div class="col-md-3 mb-2">
            <h6>Monthly Rate</h6>
            <input type="number" name="monthlyrate"
                value="@isset($edit){{ $data['monthly_sal'] }}@endisset" required
                class="form-control form-control-sm">
        </div>
        <div class="col-md-3 mb-2">
            <h6>Salary Grade</h6>
            <input type="text" name="salarygrade"
                value="@isset($edit){{ $data['salary'] }}@endisset" required
                class="form-control form-control-sm">
        </div>
        <div class="col-md-12 mb-2">
            <h6>Office</h6>
          
          
            @php
            if(isset($edit)){
                $officeid = '';
            $officename = '';
                foreach ($offices as  $value) {
                    if($value->ID == $data['office_id']){
                        $officeid = $value->ID;
                        $officename = $value->Office;
                    }
                }
            }
          
            @endphp     
 
  
        <select name="office" required class="form-select form-select-sm form-control-sm" id="">
            <option value="@isset($edit){{ $officeid  }}@endisset">
                @isset($edit)
                    {{$officename}}
                @else
                    Select Office
                @endisset
            </option>
            @foreach ($offices as $val)
             
                <option value="{{ $val['ID'] }}">{{ $val['Office'] }}</option>
            @endforeach
        </select>
        </div>
        <div class="col-md-12 mb-2">
            <h6>Description</h6>
            <textarea name="description" required class="form-control" id="" cols="30" rows="3">
@isset($edit)
{{ $data['description'] }}
@else
N/A
@endisset
</textarea>
        </div>

        <div class="col-md-12 mb-2">
            <h6>Eigibility</h6>
            <textarea name="eligibility" required class="form-control" id="" cols="30" rows="3">
@isset($edit)
{{ $data['eligibility'] }}
@else
None Required
@endisset
</textarea>
        </div>

        <div class="col-md-12 mb-2">
            <h6>Trainings</h6>
            <textarea name="trainings" required class="form-control" id="" cols="30" rows="3">
@isset($edit)
{{ $data['trainings'] }}
@else
N/A
@endisset
</textarea>
        </div>

        <div class="col-md-12 mb-2">
            <h6>Competencies</h6>
            <textarea name="competencies" required class="form-control" id="" cols="30" rows="3">
@isset($edit)
{{ $data['competencies'] }}
@else
N/A
@endisset
</textarea>
        </div>

        <div class="col-md-12 mb-2">
            <h6>Educational Background</h6>
            <textarea name="education" required class="form-control" id="" cols="30" rows="3">
@isset($edit)
{{ $data['educational_background'] }}
@else
N/A
@endisset
</textarea>
        </div>
    </div>

    <button type="submit" class="btn btn-primary btn-sm px-3" style="float:right">Save</button>
</form>
