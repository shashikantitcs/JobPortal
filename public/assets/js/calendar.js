(function($) {
    'use strict';
    $(function() {
      let d = new Date();
      var calendarData =[];

      function callCalendar(calendarData){
        if ($('#calendar').length) {
          $('#calendar').fullCalendar({
            header: {
              left: 'prev,next today',
              center: 'title',
              right: 'month,basicWeek,basicDay'
            },
            defaultDate: new Date(d.getFullYear()+'-'+ (d.getMonth()+1)+'-'+d.getDate()),
            defaultView: 'month',
            navLinks: true, // can click day/week names to navigate views
            editable: false,
            allDayDefault: false,
            eventLimit: 2, // allow "more" link when too many events
            events: calendarData,
            // events: [calendarData]
          });
          $('#calendar').fullCalendar('removeEvents', function () { return true; });
          $('#calendar').fullCalendar('addEventSource', calendarData, true);
        }
      }

      function getCalendar(data = null){
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type: "POST",
        url: 'getCalendarData',
        data: data,
        dataType: "json",
        async:false,
        success: function (res) {
         if(res){
          calendarData = res.data;

          callCalendar(calendarData);
          $('#calendar').fullCalendar('refresh');
          // $("#calendar").refetchEvents();
         }
        }
      });
    }
    getCalendar();

    $('.fc-next-button, .fc-prev-button').click(function () {
      var date = $("#calendar").fullCalendar('getDate');
       let month = new Date(date).getMonth()+1;
       let year = new Date(date).getFullYear();
      let data ={"month":month,"year":year}
       getCalendar(data)
    });
    // $('.fc-prev-button').click(function () {
    //   var date = $("#calendar").fullCalendar('getDate');
    //    let month = new Date(date).getMonth()+1;
    //    alert(month);
    //    let year = new Date(date).getFullYear();
    //   let data ={"month":month,"year":year}
    //    getCalendar(data)
    // });


    });
  })(jQuery);
