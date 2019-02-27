$(document).ready(function() {

    now = new Date;
    month = now.getMonth()+1;
    date = now.getFullYear() + '-' + month  + '-' + now.getDate();
    
    $.get('http://dev.consultorio.com/query/markedquerys', function( data ) {
        console.log(data)
        //var consultas = '';
        //$.each( data, function( key, val ) {
        //    date = val.date_query;
        //    consultas += "{title: 'Consulta Marcada', start: '"+date.replace(" ", "T")+"'},";
        //})
        $('#calendar').fullCalendar({
            defaultView: 'month',
            locale: 'pt-br',
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            defaultDate: date,
            navLinks: true, // can click day/week names to navigate views
            events: data
        });
        //console.log(consultas);
    });

});