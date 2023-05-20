<div class="">

    <div class="card-body">
        <div class="row mt-3">
            <div class="col-md-2 mb-2">
                <button class="customaddBtn px-2 " id="btnreload" onclick="window.location.reload()">Reload <i
                        class="fas fa-sync"></i></button>


                <button class="customaddBtn px-2 mt-2 " id=""
                    onclick="window.location.href='{{ route('admin.jobapplications') }}'">Reset <i
                        class="fas fa-cog"></i></button>
            </div>
            <div class="col-md-5 mb-2">

                <select name="" class="form-select" id="filterstatus">
                    @if (request()->has('status'))
                        @switch(request('status'))
                            @case(null)
                                <option value="">All</option>
                                <option value="0">Not Qualified</option>
                                <option value="1">Pending</option>
                                <option value="2">For Interview</option>
                                <option value="100">Hired</option>
                                <option value="">Newest ( within 31 days )</option>
                            @break

                            @case(0)
                                <option value="0">Not Qualified</option>
                                <option value="1">Pending</option>
                                <option value="2">For Interview</option>
                                <option value="100">Hired</option>
                                <option value="">Newest ( within 31 days )</option>
                            @break

                            @case(1)
                                <option value="1">Pending</option>
                                <option value="0">Not Qualified</option>
                                <option value="2">For Interview</option>
                                <option value="100">Hired</option>
                                <option value="">Newest ( within 31 days )</option>
                            @break

                            @case(2)
                                <option value="2">For Interview</option>
                                <option value="0">Not Qualified</option>
                                <option value="1">Pending</option>
                                <option value="100">Hired</option>
                                <option value="">Newest ( within 31 days )</option>
                            @break

                            @case(100)
                                <option value="100">Hired</option>
                                <option value="2">For Interview</option>
                                <option value="0">Not Qualified</option>
                                <option value="1">Pending</option>
                                <option value="">Newest ( within 31 days )</option>
                            @break
                        @endswitch
                    @else
                        <option value="">Newest ( within 31 days )</option>
                        <option value="0">Not Qualified</option>
                        <option value="1">Pending</option>
                        <option value="2">For Interview</option>
                        <option value="100">Hired</option>
                    @endif




                </select>
            </div>

            <div class="col-md-5 mb-2">
                <select name="" class="form-select mb-2 " id="filterJobpost">
                    @if (request()->has('jobpost'))

                        @foreach ($AppliedJobpost as $item)
                            @if ($item->id == request('jobpost'))
                                <option value="{{ $item->id }}">{{ $item->title }} &middot;
                                    pt#{{ $item->plantilla_no }}</option>
                            @endif
                        @endforeach
                        <option value="">Filter By Job Position | All</option>


                        @foreach ($AppliedJobpost as $item)
                            <option value="{{ $item->id }}">{{ $item->title }} &middot;
                                pt#{{ $item->plantilla_no }}</option>
                        @endforeach
                    @else
                        <option value="">Filter By Job Position | All</option>


                        @foreach ($AppliedJobpost as $item)
                            <option value="{{ $item->id }}">{{ $item->title }} &middot;
                                pt#{{ $item->plantilla_no }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-10">
                <div class="input-group input-group-sm mb-3">
                    <input type="text" class="form-control form-sm" id="searchkey"
                        placeholder="Search for Firstname, Lastname" aria-label="username"
                        value="@if (request()->has('search')) {{ request('search') }} @endif"
                        aria-describedby="basic-addon2">
                    <span class="input-group-text" id="basic-addon2"><button class="btn btn-warning btn-sm"
                            id="search"><i class="fas fa-search"></i></button></span>
                </div>
            </div>


        </div>

    </div>

    <div id="loader" class="d-none">
        <h6 class="text-danger" style="text-align: center;text-transform:uppercase;">
            <div class="spinner-grow spinner-grow-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div class="spinner-grow spinner-grow-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div class="spinner-grow spinner-grow-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <br>
            <span style="font-size:11px">Please Wait

                @php
                    $countofPendingApplications = DB::select('select * from applications where status = 1');
                @endphp

                <div id="hidd" class="d-none">
                    <br>
                    Loading &middot; {{ count($countofPendingApplications) }} pending applications
                </div>
            </span>
        </h6>
    </div>
    @include('admin.tables.applicantsTable')
    <div class="mb-5"></div>
</div>
</div>

<script>
    $(document).ready(function() {

        $('#search').click(function() {
            var searchkey = $('#searchkey').val();
            var jobpost = $('#filterJobpost').val();
            var status = $('#filterstatus').val();
            if (!searchkey) {
                $('#searchkey').addClass('is-invalid');
                return;
            }

            window.location.href = `?status=${status}&jobpost=${jobpost}&search=${searchkey}`;
        })

        $('#searchkey').keyup(function() {
            $('#searchkey').removeClass('is-invalid');
        })

        $('#searchkey').keypress(function(event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                var searchkey = $('#searchkey').val();
                var jobpost = $('#filterJobpost').val();
                var status = $('#filterstatus').val();
                if (!searchkey) {
                    $('#searchkey').addClass('is-invalid');
                    return;
                }

                window.location.href = `?status=${status}&jobpost=${jobpost}&search=${searchkey}`;
            }
        });

        $('#filterstatus').change(function() {
            $('#loader').removeClass('d-none');
            var searchkey = $('#searchkey').val();
            var jobpost = $('#filterJobpost').val();
            var status = $(this).val();
            if (status == 1 && jobpost == '') {
                $('#hidd').removeClass('d-none');

            }
            $('#loader').removeClass('d-none');
            window.location.href = `?status=${status}&jobpost=${jobpost}&search=${searchkey}`;


        })
        $('#filterJobpost').change(function() {
            $('#loader').removeClass('d-none');
            var searchkey = $('#searchkey').val();
            var jobpost = $(this).val();
            var status = $('#filterstatus').val();

            window.location.href = `?status=${status}&jobpost=${jobpost}&search=${searchkey}`;

        })
    })
</script>
