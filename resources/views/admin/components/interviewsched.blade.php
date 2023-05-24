<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/index.global.min.js'></script>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.print.min.css" media="print" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.1/darkly/bootstrap.min.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
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

    });
    calendar.render();

    var calendarContainer = calendarEl.closest('#calendar');
    

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
    

    @foreach ($InterviewSched as $item)
     calendar.addEvent({
      title: '{{$item->Name}}',
      start: ' {{date('Y-m-d',strtotime($item->interview_date))}}', 
    });
    @endforeach
   
   
  });

</script>


<div class="container-fluid p-4">

    <div id='calendar'></div>
</div>