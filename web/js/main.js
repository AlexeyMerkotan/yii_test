$(function() {
    $(document).on('click','.fc-day',function () {
        var date=$(this).attr('data-date');
        //alert(date);
        var title = prompt('Event Title:');
        var events;
        if (title) {
            events = {
                title: title,
                start: date,
                end: date
            };
            $('#w0').fullCalendar('renderEvent', events, true);
        }
        $('#w0').fullCalendar('unselect');
    });

});

/*function (start, end) {
        var title = prompt('Event Title:');
        var eventData;
        if (title) {
            eventData = {
                title: title,
                start: start,
                end: end
            };
            $('#w0').fullCalendar('renderEvent', eventData, true);
        }
        $('#w0').fullCalendar('unselect');
    }
function (calEvent, jsEvent, view) {

        alert('Event: ' + calEvent.title);
        alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
        alert('View: ' + view.name);

        // change the border color just for fun
        $(this).css('border-color', 'red');

    }*/
