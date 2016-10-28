var start_at;
var id;

function Select_Project(select) {
    $.get('index.php?r=modelview%2Fselect',{'select':select},function(date){
        var project=$.parseJSON(date);
        $('#calendar-id_project').html('');
        $.each(project, function(key, value) {
            var option1 = $('#calendar-id_project').append($("<option >", {
                "value": value.id,
                text: value.name
            }));
        })
    });

}
function clean() {
    $('#modal').on('hidden.bs.modal', function () {
        $(this).find("input,textarea,select").val('').end();
    });
}

$(function() {


    //view model windows
    $(document).on('click','.fc-day',function () {

        clean();
        $( ".btn-success" ).prop( "disabled", false );
        $( ".btn-danger" ).prop( "disabled", true );
        $( ".btn-primary" ).prop( "disabled", true );
        start_at=$(this).attr('data-date');
        $('#modal').modal('show')
            .find('#modal-content')
            .load($(this).attr('data-target'));
        var queryDate = start_at,
            dateParts = queryDate.match(/(\d+)/g),
            realDate = new Date(dateParts[0], dateParts[1] - 1, dateParts[2]);
        $('#date-picker1-update').datepicker('setDate', (realDate) );



    });

    //delete data calendar
    $(document).on('click','.btn-danger',function(){
        var form=new FormData();
        form.append('id',id);
        $.ajax({
            url:'index.php?r=modelview%2Fdelete',
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
        form.append('id',id);
        form.append('start_at',$('#calendar-start_at').val());
        form.append('id_user',$('#calendar-id_user').val());
        form.append('id_project',$('#calendar-id_project').val());
        form.append('end_at',$('#calendar-end_at').val());
        form.append('comment',$('#calendar-comment').val());
        $('#calendar').fullCalendar('removeEvents', id);
        $.ajax({
            url:'index.php?r=modelview%2Fupdate',
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
                        id: value.id,
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
        clean();
        $( ".btn-success" ).prop( "disabled", true );
        $( ".btn-danger" ).prop( "disabled", false );
        $( ".btn-primary" ).prop( "disabled", false );

        $('#modal').modal('show')
            .find('#modal-content')
            .load($(this).attr('data-target'));

        $.get('index.php?r=modelview%2Fdetermine',{'id':id},function(data){
            var project=$.parseJSON(data);
            $.each(project, function(key, value) {
                if(key=='id_user'){
                    $('#calendar-id_user').val(value);
                    Select_Project(value);
                }
                if(key=='id_project'){
                    $('#calendar-id_project').val(value);
                }
                if(key=='start_at'){
                    var queryDate = value,
                        dateParts = queryDate.match(/(\d+)/g),
                        realDate = new Date(dateParts[0], dateParts[1] - 1, dateParts[2]);
                    $('#date-picker1-update').datepicker('setDate', (realDate) );
                }
                if(key=='end_at'){
                    var queryDate = value,
                        dateParts = queryDate.match(/(\d+)/g),
                        realDate = new Date(dateParts[0], dateParts[1] - 1, dateParts[2]);
                    $('#date-picker').datepicker('setDate', (realDate) );
                }
                if(key=='comment'){
                    $('#calendar-comment').val(value);
                }

            })


        });

    });





    $(document).on('change','.user',function () {

        if($(this).is(":checked")){
            var selected=$(this).val();
            $.get('index.php?r=view%2Fchechviewuser',{'id':selected},function(data){
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
        } else {
            var selected=$(this).val();
            $.get('index.php?r=view%2Fchechuser',{'id':selected},function(data){
                var project=$.parseJSON(data);
                $.each(project, function(key, value) {
                    $('#calendar').fullCalendar('removeEvents', value.id);
                })
            });
        }




    });



    $(document).on('change','.project',function () {

        if($(this).is(":checked")){
            var selected=$(this).val();
            $.get('index.php?r=view%2Fchechviewproject',{'id':selected},function(data){
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
        } else {
            var selected=$(this).val();
            $.get('index.php?r=view%2Fchechproject',{'id':selected},function(data){
                var project=$.parseJSON(data);
                $.each(project, function(key, value) {
                    $('#calendar').fullCalendar('removeEvents', value.id);
                })
            });
        }




    });







    //add data calendar
    $(document).on('click','.btn-success',function () {
        var form=new FormData();
        form.append('start_at',$('#calendar-start_at').val());
        form.append('id_user',$('#calendar-id_user').val());
        form.append('id_project',$('#calendar-id_project').val());
        form.append('end_at',$('#calendar-end_at').val());
        form.append('comment',$('#calendar-comment').val());
        $.ajax({
            url:'index.php?r=viewmodel%2Fcreate',
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
                        id: value.id,
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
        Select_Project(select);


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
