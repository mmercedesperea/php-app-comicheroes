<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">


  <link href='assets/fullcalendar-4.3.1/packages/core/main.css' rel='stylesheet' />
  <link href='assets/fullcalendar-4.3.1/packages/daygrid/main.css' rel='stylesheet' />
  <link href='assets/fullcalendar-4.3.1/packages/timegrid/main.css' rel='stylesheet' />
  <link href='assets/fullcalendar-4.3.1/packages/list/main.css' rel='stylesheet' />
  <script src='assets/fullcalendar-4.3.1/packages/core/main.js'></script>
  <script src='assets/fullcalendar-4.3.1/packages/interaction/main.js'></script>
  <script src='assets/fullcalendar-4.3.1/packages/daygrid/main.js'></script>
  <script src='assets/fullcalendar-4.3.1/packages/timegrid/main.js'></script>
  <script src='assets/fullcalendar-4.3.1/packages/list/main.js'></script>


  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');

      var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ['interaction', 'dayGrid'],
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek'
        },
        // defaultDate: '2019-08-12',
        editable: true,
        navLinks: true, // can click day/week names to navigate views
        eventLimit: true, // allow "more" link when too many events
        events: {
          url: 'libs/Events.php',
          failure: function() {
            document.getElementById('script-warning').style.display = 'block'
          }
        },
        loading: function(bool) {
          document.getElementById('loading').style.display =
            bool ? 'block' : 'none';
        }
      });

      calendar.render();
    });
  </script>
  <style>


    .fc-toolbar h2{
      color: green;
      font-size: 16px;

    }


    .fc-view {
      background-color: white;
      /* height: 100px; */

    }

    #script-warning {
      display: none;
      background: #eee;
      border-bottom: 1px solid #ddd;
      padding: 0 10px;
      line-height: 40px;
      text-align: center;
      font-weight: bold;
      font-size: 12px;
      color: red;
    }

    #loading {
      display: none;
      position: absolute;
      top: 10px;
      right: 10px;
    }

    #calendar {
      max-width: 900px;
      margin: 10px auto;
      padding: 0 10px;
    }
  </style>
</head>

<body>

  <div id='script-warning'>
    <code>/events.php</code> must be running.
  </div>

  <div id='loading'>loading...</div>

  <div id='calendar'></div>

</body>

</html>