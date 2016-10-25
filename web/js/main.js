var date;
$(function() {
    $(document).on('click','.fc-day',function () {
        date=$(this).attr('data-date');
        //alert(date);
        $('#modal').modal('show')
            .find('#modal-content')
            .load($(this).attr('data-target'));
        /*$.get('index.php?r=signup%2Fupdate',{'date':date},function(){
            $('#model').modal('show')
                .find('#modelContent')
                .html(date);
        });*/
    });
    $(document).on('click','.btn-primary',function () {
        $.get('index.php?r=signup%2Fupdate',{'date':date},function(){
            alert("Project OK!!!");
        });
    });
    $(document).on('click','.fc-content',function () {
        $('#modal').modal('show')
            .find('#modal-content')
            .load($(this).attr('data-target'));
    });
    $(document).on('click','#calendar-id_user',function () {
        var select=$('#calendar-id_user :selected').val();
        $.ajax({
           url:'index.php?r=signup%2Fselect',
           dataType:'text',
           cache:false,
           contentType:false,
           processData:false,
           data:{ select:' select'},
           success:function (data) {
               alert(data);
               $.each(newOptions, function(key, value) {
                   $('#calendar-id_project').append($("", {
                       value: key,
                       text: value
               }));
               })
               //http://www.webnotes.com.ua/index.php/archives/699
           }
       });
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
