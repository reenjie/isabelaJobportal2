<select name="" class="form-select text-center fw-bold mb-2" id="sortbyyyear">
    @if(request()->has('year'))
    <option value="{{request('year')}}">{{request('year')}}</option>
    @endif
    <option value="">All</option>
    @php
        $years = DB::select('SELECT DISTINCT YEAR(date_created) AS year FROM applications ORDER by year desc;');
    @endphp
    @foreach ($years as $item)
    <option value="{{$item->year}}">{{$item->year}}</option> 
    @endforeach
</select>

<script>
    $(document).ready(function(){
        $('#sortbyyyear').change(function(){
            var year = $(this).val();
            if(year === ''){
                window.location.href="{{route('admin.dashboard')}}";
                return;
            }
            window.location.href=`?year=${year}`;
        })
    })
</script>
<script>

    window.onload = function () {
    @php
    
    function renderStats($month,$overall,$request ) {
        if($request->has('year')){
            $year = request('year');
            return count(array_filter($overall, function ($data) use ($month,$year) {
        return date('F', strtotime($data->date_created)) === $month && date('Y',strtotime($data->date_created)) === $year;
    }));
        }else {
            return count(array_filter($overall, function ($data) use ($month) {
        return date('F', strtotime($data->date_created)) === $month;
    }));
        }

   
    }
    @endphp


        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light1", // "light1", "light2", "dark1", "dark2"
            title: {
                text: "Job Applications"
            },
            axisY: {
                includeZero: true
            },
            data: [{
                type: "column",
                indexLabelFontColor: "#5A5757",
                indexLabelFontSize: 16,
                indexLabelPlacement: "outside",
                dataPoints: [
                    { y:{{renderStats('January',$overall,request())}}, label: "Jan" },
                    { y:{{renderStats('February',$overall,request())}}, label: "Feb" },
                    { y:{{renderStats('March',$overall,request())}}, label: "Mar" },
                    { y:{{renderStats('April',$overall,request())}}, label: "Apr" },
                    { y:{{renderStats('May',$overall,request())}}, label: "May" },
                    { y:{{renderStats('June',$overall,request())}}, label: "Jun" },
                    { y:{{renderStats('July',$overall,request())}}, label: "Jul" },
                    { y:{{renderStats('August',$overall,request())}}, label: "Aug" },
                    { y:{{renderStats('September',$overall,request())}} , label: "Sep" },
                    { y:{{renderStats('October',$overall,request())}}, label: "Oct" },
                    { y:{{renderStats('November',$overall,request())}}, label: "Nov" },
                    { y:{{ renderStats('December',$overall,request())}}, label: "Dec" }
                ]
            }]
        });
        chart.render();
    }
</script>

<div id="chartContainer" style="height: 300px; width: 100%;"></div>


<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
