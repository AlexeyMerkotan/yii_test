var start_at;
var id;



$(function() {


    //view model windows
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

    //delete data calendar
    $(document).on('click','.btn-danger',function(){
      var form=new FormData();
        form.append('id',id);
        $.ajax({
            url:'index.php?r=signup%2Fdelete',
            type: "post",
            dataType:'text',
            cache:false,
            contentType:false,
            processData:false,
            data: form,
            success:function () {
                alert('Date remove!!!');
                $('#calendar').fullCalendar('removeEvents', id);
            }
        });


    });




    //data update
    $(document).on('click','.btn-primary',function () {
        var form=new FormData();
        form.append('start_at',$(calendar-start_at).val());
        form.append('id_user',$('#calendar-id_user').val());
        form.append('id_project',$('#calendar-id_project').val());
        form.append('end_at',$('#calendar-end_at').val());
        form.append('comment',$('#calendar-comment').val());
        $.ajax({
            url:'index.php?r=signup%2Fupdate',
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


    //view data update
    $(document).on('click','.fc-content',function () {

        $('#modal1').modal('show')
            .find('#modal-content')
            .load($(this).attr('data-target'));
        $.get('index.php?r=signup%2Fdetermine',{'id':id},function(data){
                var project=$.parseJSON(data);
                $.each(project, function(key, value) {

                    $('#hidden').val(this.getAttribute('param'));
                    $('input[name="Calendar[]"]').val(value.comment);



                })


        });

     });





    $(document).on('change','.user',function () {
        /*
        $(function(){

            $(document).on('click','.user',function(){


            //$('#user input:checked').each(function(){
            //используй is
                if($(this).is(":checked")) {alert("Вы активировали переключатель "+$(this).val()); } 
               else {alert("Вы деактивировали переключатель"+$(this).val());}
            //alert($(this).prop( "checked" ));
            //alert($(this).val());
            // $("#user input").attr("checked", false);
            //});
            });

            });
        */
        var selected=$('input:checked').val();
        var flag=$(this).prop( "checked" );
        if(flag){
            $.get('index.php?r=signup%2Fchechuser',{'id':selected},function(data){
                var project=$.parseJSON(data);
                $.each(project, function(key, value) {
                    $('#calendar').fullCalendar('removeEvents', value.id);
                })
            });
        }else{
            $.get('index.php?r=signup%2Fchechviewuser',{'id':selected},function(data){
                var project=$.parseJSON(data);
                $.each(project, function(key, value) {
                    var eventData = {
                        id:value.id,
                        title: "Project("+value.project+")",
                        start: value.start_at,
                        end: value.end_at,
                        color:value.color,
                    };
                    $('#calendar').fullCalendar('renderEvent', eventData, true);
                })
            });
        }



    });


    $(document).on('change','.project',function () {
        var selected=$('input:checked').val();
        $.get('index.php?r=signup%2Fchechproject',{'id':selected},function(data){
            var project=$.parseJSON(data);
            $.each(project, function(key, value) {
                $('#calendar').fullCalendar('removeEvents', value.id);
            })


        });

    });






    //add data calendar
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



    //view project to user
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

































//alert(id);
/* $('#modal1').modal('show')
 .find('#modal-content')
 .load($(this).attr('data-target'));*/





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
