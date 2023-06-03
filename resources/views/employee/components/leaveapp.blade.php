<div class="p-2">
    <form action="{{ route('save.leaveapplication') }}" method="post">
        @csrf
        <h6>DATES</h6>
        <div class="row">
            <div class="col-md-6">
                <h6>From</h6>
                <input type="date" required class="form-control" name="from">
            </div>
            <div class="col-md-6">
                <h6>To</h6>
                <input type="date" required class="form-control" name="to">
            </div>

        </div>
        <select name="leavetype" class="form-select mt-2 mb-4" id="LeaveType">
            <option value="">Select Type of Leave</option>
            <option value="{{ json_encode(['id' => '1', 'name' => 'Vacation Leave']) }}">Vacation Leave</option>
            <option value="{{ json_encode(['id' => '2', 'name' => 'Mandatory/Forced Leave']) }}">Mandatory/Forced Leave
            </option>
            <option value="{{ json_encode(['id' => '3', 'name' => 'Sick Leave']) }}">Sick Leave</option>
            <option value="{{ json_encode(['id' => '4', 'name' => 'Maternity Leave']) }}">Maternity Leave</option>
            <option value="{{ json_encode(['id' => '5', 'name' => 'Paternity Leave']) }}">Paternity Leave</option>
            <option value="{{ json_encode(['id' => '6', 'name' => 'Special Previledge']) }}">Special Previledge</option>
            <option value="{{ json_encode(['id' => '7', 'name' => 'Solo Parent Leave']) }}">Solo Parent Leave</option>
            <option value="{{ json_encode(['id' => '8', 'name' => 'Study Leave']) }}">Study Leave</option>
            <option value="{{ json_encode(['id' => '9', 'name' => '10-Day VAWC Leave']) }}">10-Day VAWC Leave</option>
            <option value="{{ json_encode(['id' => '10', 'name' => 'Rehabilitation Previledge']) }}">Rehabilitation
                Previledge</option>
            <option value="{{ json_encode(['id' => '11', 'name' => 'Special Leave Benefits for Women']) }}">Special Leave
                Benefits for Women</option>
            <option value="{{ json_encode(['id' => '12', 'name' => 'Special Emergency( Calamity ) Leave']) }}">Special
                Emergency( Calamity ) Leave</option>
            <option value="{{ json_encode(['id' => '13', 'name' => 'Adoption Leave']) }}">Adoption Leave</option>
            <option value="{{ json_encode(['id' => '14', 'name' => 'Birthday Leave']) }}">Birthday Leave</option>
        </select>



        <div id="vacation" class="d-none hideall">
            <h6 style="font-size:12px;text-transform:uppercase;color:gray">Optional Information</h6>
            <h6>Within Philippines</h6>
            <input type="text" class="form-control mb-2 ">

            <h6>Abroad</h6>
            <input type="text" class="form-control">

        </div>

        <div id="sick" class="d-none hideall">
            <h6 style="font-size:12px;text-transform:uppercase;color:gray">Optional Information</h6>
            <h6>In Hospital</h6>
            <input type="text" class="form-control mb-2 ">

            <h6>Out Patient</h6>
            <input type="text" class="form-control">

        </div>

        <div id="study" class="d-none hideall">
            <h6 style="font-size:12px;text-transform:uppercase;color:gray">Optional Information</h6>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                <label class="form-check-label" for="flexRadioDefault1">
                    Completion of Master's Degree
                </label>
            </div>
            <div class="form-check ">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                <label class="form-check-label" for="flexRadioDefault2">
                    BAR/Board Examination Review
                </label>
            </div>
        </div>

        <div id="Special" class="d-none hideall">
            <h6 style="font-size:12px;text-transform:uppercase;color:gray">Optional Information</h6>
            <h6>Special illness</h6>
            <input type="text" class="form-control">
        </div>
        <div style="display: flex;justify-content:flex-end">
            <button type="submit" class="customaddBtn px-5 mt-5 py-2 mb-3">Submit</button>
        </div>
    </form>
</div>

<script>
    $(document).ready(function() {
        $('#LeaveType').change(function() {
            var val = JSON.parse($(this).val());

            if (val.id == '') {
                $('.hideall').addClass('d-none');
                return;
            }
            switch (val.id) {
                case '1':
                    $('.hideall').addClass('d-none');
                    $('#vacation').removeClass('d-none');
                    break;
                case '3':
                    $('.hideall').addClass('d-none');
                    $('#sick').removeClass('d-none');
                    break;

                case '8':
                    $('.hideall').addClass('d-none');
                    $('#study').removeClass('d-none');
                    break;

                case '11':
                    $('.hideall').addClass('d-none');
                    $('#Special').removeClass('d-none');
                    break;

                default:
                    $('.hideall').addClass('d-none');
                    break;

            }

        })
    });
</script>
