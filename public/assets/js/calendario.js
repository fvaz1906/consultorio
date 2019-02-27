$(document).ready(function() {
    now = new Date;
    month = now.getMonth()+1;
    date = now.getFullYear() + '-' + month  + '-' + now.getDate();
    $('#calendar').fullCalendar({
        defaultView: 'month',
        locale: 'pt-br',
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        defaultDate: date,
        navLinks: true,
        eventClick: function(event) {
            console.log(event.id)
        },
        eventRender: function(eventObj, $el) {
            $el.popover({
                title: eventObj.title,
                content: eventObj.description,
                trigger: 'hover',
                placement: 'top',
                container: 'body'
            });
        },
        events: function(start, end, timezone, callback) {
            $.ajax({
                url: 'http://dev.consultorio.com/query/markedquerys',
                dataType: 'json',
                success: function(doc) {
                    var events = [];
                    for (i in doc){
                        var date = new Date(doc[i].date_query)
                        month = date.getMonth()+1;
                        events.push({
                            id: doc[i].id,
                            title: 'Consulta: ' + doc[i].name + ', ' + date.getHours() + ':' + date.getMinutes(),
                            description: 'Consulta agendada para ' + doc[i].name + ' no dia ' + date.getUTCDate() + '/' + month + '/' + date.getFullYear() + ' às ' + date.getHours() + ':' + date.getMinutes(),
                            start: doc[i].date_query.replace(' ', 'T')
                        });
                    }
                    callback(events);
                }
            });
        }
    });
});