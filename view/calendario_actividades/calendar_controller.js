$(function () {
    /* initialize the calendar */
    var date = new Date()
    var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear()

    var Calendar = FullCalendar.Calendar;
    var calendarEl = document.getElementById('calendar');

    var calendar = new Calendar(calendarEl, {
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        themeSystem: 'bootstrap',
        events: [
            {
                title: 'All Day Event',
                start: new Date(y, m, 1),
                backgroundColor: '#f56954',
                borderColor: '#f56954',
                allDay: true
            },
            {
                title: 'Long Event',
                start: new Date(y, m, d - 5),
                end: new Date(y, m, d - 2),
                backgroundColor: '#f39c12',
                borderColor: '#f39c12'
            },
            {
                title: 'Meeting',
                start: new Date(y, m, d, 10, 30),
                allDay: false,
                backgroundColor: '#0073b7',
                borderColor: '#0073b7'
            }
        ],
        editable: false,
        droppable: false,
    });

    calendar.render();

    // Forzar la actualización cuando el tab-pane del calendario se muestra
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target).attr("href"); // Obtiene el id del tab activo
        if (target === '#calendar') {
            calendar.updateSize(); // O usa calendar.render(); si es necesario
        }
    });
});
