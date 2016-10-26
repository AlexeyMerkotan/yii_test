var start_at;
$(function() {




    $(document).on('click','.fc-day',function () {
        start_at=$(this).attr('data-date');
        $('#modal').modal('show')
            .find('#modal-content')
            .load($(this).attr('data-target'));
        $.get('index.php?r=signup%2Fselectview',function(date){
            var project=$.parseJSON(date);
            $('#calendar-id_project').html('');
            $.each(project, function(key, value) {
                var option1 = $('#calendar-id_user').append($("<option >", {
                    "value": value.id,
                    text: value.name
                }));
            })
        });


    });
    $(document).on('click','.fc-content',function () {
            /* $('#modal1').modal('show')
             .find('#modal-content')
             .load($(this).attr('data-target'));*/
        var callendara= $('#calendar');

        callendara.fullCalendar({
            eventClick: function(calEvent, jsEvent, view) {

                alert('Event: ' + calEvent.title);
                alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
                alert('View: ' + view.name);

                // change the border color just for fun
                $(this).css('border-color', 'red');

            }
        });




       /* var id=6;
            $.get('index.php?r=signup%2Fdetermine',{'id':id},function(date){
                var project=$.parseJSON(date);
                $.each(project, function(key, value) {
                    $('#comment').append( {
                        text: value.name
                    });
                    var option1 = $('#calendar-id_project').append($("<option >", {
                        "value": value.id,
                        text: value.name
                    }));

                })
            });
        $.get('index.php?r=signup%2Fselectview',function(date){
            var project=$.parseJSON(date);
            $('#calendar-id_project').html('');
            $.each(project, function(key, value) {
                var option1 = $('#calendar-id_user').append($("<option >", {
                    "value": value.id,
                    text: value.name
                }));
            })
        });*/


     });

    $(document).on('click','.btn-success',function () {
        var form=new FormData();
        form.append('start_at',start_at);
        form.append('id_user',$('#calendar-id_user').val());
        form.append('id_project',$('#calendar-id_project').val());
        form.append('end_at',$('#calendar-end_at').val());
        form.append('comment',$('#calendar-comment').val());
        $.ajax({
            url:'index.php?r=signup%2Fcreate',
            type: "post",
            dataType:'text',
            cache:false,
            contentType:false,
            processData:false,
            data: form,
            success:function (date) {
                var project=$.parseJSON(date);
                $.each(project, function(key, value) {



                    var eventData = {
                        title: "Project("+value.project+")",
                        start: value.start_at,
                        end: value.end_at,
                        color:value.color,
                    };
                    $('#calendar').fullCalendar('renderEvent', eventData, true);
                    $('#calendar').fullCalendar('addEventSource',eventData);

                })

            }
        });

    });

    $(document).on('change','#calendar-id_user',function () {
        var select=$('#calendar-id_user :selected').val();
        $.get('index.php?r=signup%2Fselect',{'select':select},function(date){
            var project=$.parseJSON(date);
            $('#calendar-id_project').html('');
            $.each(project, function(key, value) {
                var option1 = $('#calendar-id_project').append($("<option >", {
                    "value": value.id,
                    text: value.name
                }));
            })
        });

    });

});




































/*$('#calendar-id_project').append($("", {
 value: value.id,
 text: value.name
 }));*/
//$('#calendar-id_project').append("<option value='" + value.id + "'>" + value.name + "</option>");

/*


$.ajax({
 url:'index.php?r=signup%2Fselect',
 dataType:'text',
 cache:false,
 contentType:false,
 processData:false,
 data:{ select:' select'},
 ssuccess:function (data) {
 alert(sdata);
 $.each(newOptions, function(key, value) {
 $('#calendar-id_project').append($("", {
 value: key,
 text: value
 }));
 })
 //http://www.webnotes.com.ua/index.php/archives/699
 }
 });*/
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
