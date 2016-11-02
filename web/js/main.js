var start_at;
var id;
var user;


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

    $("p.help-block-error").empty();
    $(".form-group").removeClass("has-error");
    $('#modal').on('hidden.bs.modal', function () {
        $(this).find("input,textarea,select").val('').end();
    });
}


$(function() {


    $( "#draggable" ).draggable();
    //view model windows
    $(document).on('click','.fc-day',function () {

        clean();
        $('.btn-success').show();
        $('.btn-primary').hide();
        $('.btn-danger').hide();
        start_at=$(this).attr('data-date');
        $('#modal').modal('show')
            .find('#modal-content')
            .load($(this).attr('data-target'));
        var queryDate = start_at,
            dateParts = queryDate.match(/(\d+)/g),
            realDate = new Date(dateParts[0], dateParts[1] - 1, dateParts[2]);
        $('#calendar-start_at').datetimepicker('setDate', (realDate) );


    });


    $(document).on('click','.btn-info',function () {

        clean();
        $('.btn-success').show();
        $('.btn-primary').hide();
        $('.btn-danger').hide();
        $('#modal').modal('show')
            .find('#modal-content')
            .load($(this).attr('data-target'));

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
        $('.btn-success').hide();
        $('.btn-primary').show();
        $('.btn-danger').show();

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
                        realDate = new Date(dateParts[0], dateParts[1] - 1, dateParts[2],dateParts[3],dateParts[4]);
                    $('#calendar-start_at').datetimepicker('setDate', (realDate) );
                }
                if(key=='end_at'){
                    var queryDate = value,
                        dateParts = queryDate.match(/(\d+)/g),
                        realDate = new Date(dateParts[0], dateParts[1] - 1, dateParts[2],dateParts[3],dateParts[4]);
                    $('#calendar-end_at').datetimepicker('setDate', (realDate) );
                }
                if(key=='comment'){
                    $('#calendar-comment').val(value);
                }

            })


        });

    });






    $(document).on('click','#filter',function () {


        var id_user = [];
        $('.user input:checkbox:checked').each(function(){
            var checkbox_value = $(this).val();
            id_user.push(checkbox_value);
        });

            var id_project = [];
            $('.project input:checkbox:checked').each(function(){
                var checkbox_value = $(this).val();
                id_project.push(checkbox_value);
            });

            var form=new FormData();
            form.append('id_user',JSON.stringify(id_user));
            form.append('id_project',JSON.stringify(id_project));
            $.ajax({
                url:'index.php?r=view%2Fchechviewproject',
                type: "post",
                dataType:'text',
                cache:false,
                contentType:false,
                processData:false,
                data: form,
                success:function (date) {
                    var project=$.parseJSON(date);
                    $('#calendar').fullCalendar('removeEvents');
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
                }
            });

    });







    //add data calendar
    $(document).on('click','.btn-success',function () {

        clean();
        var form=new FormData();
        form.append('start_at',$('#calendar-start_at').val());
        form.append('id_user',$('#calendar-id_user').val());
        form.append('id_project',$('#calendar-id_project').val());
        form.append('end_at',$('#calendar-end_at').val());
        form.append('comment',$('#calendar-comment').val());
        $.ajax({
            url:'index.php?r=modelview%2Fcreate',
            type: "post",
            dataType:'text',
            cache:false,
            contentType:false,
            processData:false,
            data: form,
            success:function (date) {
                $('#messageShow').hide();
                var error="";
                var project=$.parseJSON(date);
                $.each(project, function(key, value) {

                    if(value.flag){
                        var eventData = {
                            id: value.id,
                            title: "Project("+value.project+")",
                            start: value.start_at,
                            end: value.end_at,
                            color:value.color,
                        };
                        $('#calendar').fullCalendar('renderEvent', eventData, true);
                        $('#calendar').fullCalendar('addEventSource',eventData);
                        $('#modal').modal('hide');
                    }else {
                        $('#calendar-form').data('yiiActiveForm').submitting = true;

                        $('#calendar-form').yiiActiveForm('validate');
                    }


                })

            }
        });

    });



    //view project to user
    $(document).on('change','#calendar-id_user',function () {
        var select=$('#calendar-id_user :selected').val();
        Select_Project(select);


    });

        //user to project
        $(document).on('change','.projection',function () {
            if($(this).is(":checked")){
                var selected=$(this).val();
                $.get('index.php?r=user%2Faddproject',{'id':selected,'id_user':user},function(data){
                   alert('Add project user');
                });
            } else {
                var selected=$(this).val();
                $.get('index.php?r=user%2Fremoveproject',{'id':selected,'id_user':user},function(data){
                    alert('Remove project user');
                });
            }
        });
});




