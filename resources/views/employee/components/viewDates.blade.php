<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Leave Dates</title>
</head>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/index.global.min.js'></script>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.print.min.css" media="print" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.1/darkly/bootstrap.min.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendars');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      themeSystem: 'bootstrap',
      dayMaxEventRows:4,
      headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },
    views: {
      dayGridMonth: {
        titleFormat: { year: 'numeric', month: 'long' } // Include month names in the title
      }
    },
      eventRender: function(info) {
      if (info.el.classList.contains('fc-more')) {
        // Replace the default "View more" link with a custom link
        var link = document.createElement('a');
        link.innerText = '+ View more';
        link.href = 'javascript:void(0)';
        link.addEventListener('click', function() {
          // Remove the maximum event rows limit when the link is clicked
          calendar.setOption('dayMaxEventRows', false);
        });
        info.el.innerHTML = '';
        info.el.appendChild(link);
      }
    },
    initialDate: "{{date('Y-m-d',strtotime($dates[0]))}}"
    });
    calendar.render();

    var calendarContainer = calendarEl.closest('#calendars');
    

    function getRandomColor() {
      var letters = '0123456789ABCDEF';
      var color = '#';
      for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
      }
      return color;
    }
    // Set the background color to black
    calendarContainer.style.backgroundColor = 'white';
    calendarContainer.style.padding = '10px';
    

 
    @php
    $lastDate = $dates[count($dates) - 1];
    $nextDay = date('Y-m-d', strtotime($lastDate . ' +1 day'));
    @endphp
    calendar.addEvent({
      title: '{{$leavetype}}',
      start: '{{$dates[0]}}', 
      end : "{{$nextDay}}"
    });
    

    @foreach ($dates as $item)
     calendar.addEvent({
      title: '{{$item}}',
      start: ' {{date('Y-m-d',strtotime($item))}}', 
    });
    @endforeach
   
   
  });

</script>
<style>
    #calendars {
      width: 100%; /* Set the width as per your desired size */
      height: 70vh; /* Set the height as per your desired size */
      margin: 0 auto; /* Center the calendar horizontally */
    }
  </style>

<div class="container-fluid p-5">
    <h4>Leave Dates</h4>

    <div id='calendars' ></div>
</div>

{{-- 
    
    @foreach (explode(",",$datescovered) as $item)
     calendar.addEvent({
      title: '{{$item}}',
      start: ' {{date('Y-m-d',strtotime($item))}}', 
    });
    @endforeach --}}