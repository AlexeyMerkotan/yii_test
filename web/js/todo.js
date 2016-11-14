

function clean() {

    $("p.help-block-error").empty();
    $(".form-group").removeClass("has-error");
    $('#modal').on('hidden.bs.modal', function () {
        $(this).find("input,textarea,select").val('').end();
    });
}


$(document).on('click','#task',function () {

    clean();
    $('.btn-success').show();
    $('.btn-primary').hide();
    $('.btn-danger').hide();
    $('#modal').modal('show')
        .find('#modal-content')
        .load($(this).attr('data-target'));

});
function Select_Project(select) {
    var select=$('#task-id_user :selected').val();
    $.get('index.php?r=modelview%2Fselect',{'select':select},function(date){
        var project=$.parseJSON(date);
        $('#task-id_project').html('');
        $.each(project, function(key, value) {
            var option1 = $('#task-id_project').append($("<option >", {
                "value": value.id,
                text: value.name
            }));
        })
    });
}
$(document).on('change','#task-id_user',function () {
    var select=$('#task-id_user :selected').val();
    Select_Project(select);
});



var todo = todo || {},
    data = JSON.parse(localStorage.getItem("todoData"));

data = data || {};

var id;

(function(todo, data, $) {



    var defaults = {
        todoTask: "todo-task",
        todoHeader: "task-header",
        todoDate: "task-date",
        todoDescription: "task-description",
        taskId: "task-",
        formId: "todo-form",
        dataAttribute: "data",
        deleteDiv: "delete-div"
    }, codes = {
        "1" : "#pending",
        "2" : "#inProgress",
        "3" : "#completed"
    };



    todo.init = function (options) {

        options = options || {};
        options = $.extend({}, defaults, options);

        this.clear();



        $.ajax({
            url:'index.php?r=home%2Ftasksview',
            cache:false,
            success: function(json){
                data=$.parseJSON(json);
                 $.each(data, function (index, params) {
                 generateElement(params);
                 });
            }
        })







        /*generateElement({
         id: "123",
         code: "1",
         title: "asd",
         date: "22/12/2013",
         description: "Blah Blah"
         });

         removeElement({
         id: "123",
         code: "1",
         title: "asd",
         date: "22/12/2013",
         description: "Blah Blah"
         });*/

        // Adding drop function to each category of task
       $.each(codes, function (index, value) {
            $(value).droppable({
                drop: function (event, ui) {
                    var element = ui.helper,
                        css_id = element.attr("id"),
                        id = css_id.replace(options.taskId, ""),
                        object= data[task(id)];
                        //object = data[id];

                    // Removing old element
                    removeElement(object);

                    // Changing object code
                    object.task_status = index;

                    $.get( "index.php?r=home%2Ftaskstatus", { id: id, status: index } );

                    // Generating new element
                    generateElement(object);

                    // Updating Local Storage
                    data[task(id)] = object;
                    localStorage.setItem("todoData", JSON.stringify(data));

                    // Hiding Delete Area
                    $("#" + defaults.deleteDiv).hide();
                }
            });
        });

        // Adding drop function to delete div
        $("#" + options.deleteDiv).droppable({
            drop: function(event, ui) {
                var element = ui.helper,
                    css_id = element.attr("id"),
                    id = css_id.replace(options.taskId, ""),
                    object = data[task(id)];

                // Removing old element
                removeElement(object);

                // Updating local storage
                delete data[task(id)];
                localStorage.setItem("todoData", JSON.stringify(data));

                // Hiding Delete Area
                $("#" + defaults.deleteDiv).hide();
            }
        })

    };

    var task=function (task) {
        var id;
        for(var i=0;i<data.length;i++)
            if(data[i].id==task)
                id=i;
        return id;
    }
    var clicks=function (params) {
        clean();
        $('.btn-success').hide();
        $('.btn-primary').show();
        $('.btn-danger').show();
        $('#modal').modal('show')
            .find('#modal-content')
            .load($(this).attr('data-target'));

        $.get('index.php?r=home%2Fdetermine',{'id':params.id},function(data){
            var task=$.parseJSON(data);
            $.each(task, function(key, value) {
                if(key=='id'){
                    id=value;
                }
                if(key=='name'){
                    $('#task-name').val(value);
                }
                if(key=='id_user'){
                    $('#task-id_user').val(value);
                    Select_Project(value);
                }
                if(key=='id_project'){
                    $('#task-id_project').val(value);
                }
                if(key=='description'){
                    $('#task-description').val(value);
                }
                if(key=='priority'){
                    $('#task-priority').val(value);
                }
                if(key=='start_at'){
                    var queryDate = value,
                        dateParts = queryDate.match(/(\d+)/g),
                        realDate = new Date(dateParts[0], dateParts[1] - 1, dateParts[2],dateParts[3],dateParts[4]);
                    $('#task-start_at').datetimepicker('setDate', (realDate) );
                }
                if(key=='end_at'){
                    var queryDate = value,
                        dateParts = queryDate.match(/(\d+)/g),
                        realDate = new Date(dateParts[0], dateParts[1] - 1, dateParts[2],dateParts[3],dateParts[4]);
                    $('#task-end_at').datetimepicker('setDate', (realDate) );
                }

            })


        });
    }

    // Add Task
    var generateElement = function(params){
        var parent = $(codes[params.task_status]),
            wrapper;

        if (!parent) {
            return;
        }

        var border=['#ff0000','#ff8000','#ffbf00','#ffff00','#009933'];

        wrapper = $("<div id='"+(defaults.taskId + params.id)+"' class='"+defaults.todoTask+" ' data='"+params.id+"' style=' border: 2px solid "+border[params.priority]+";'></div>").appendTo(parent);

        $("<div />", {
            "class" : defaults.todoHeader,
            "text": params.name
        }).appendTo(wrapper);

        $("<div />", {
            "class" : defaults.todoDescription,
            "text": params.description
        }).appendTo(wrapper);

        $("<div />", {
            "class" : defaults.todoDate,
            "text": params.start_at+" - "+params.end_at
        }).appendTo(wrapper);


        wrapper.click(function () {
            clicks(params);
        });

        wrapper.draggable({
            start: function() {
                $("#" + defaults.deleteDiv).show();
            },
            stop: function() {
                $("#" + defaults.deleteDiv).hide();
            },
            revert: "invalid",
            revertDuration : 200
        });

    };

    // Remove task
    var removeElement = function (params) {
        $("#" + defaults.taskId + params.id).remove();
    };


    todo.filter=function () {


        var id_project = [];
        $('.project input:checkbox:checked').each(function(){
            var checkbox_value = $(this).val();
            id_project.push(checkbox_value);
        });
        for(var i=0;i<data.length;i++)
            removeElement(data[i]);
        for(var j=0;j<id_project.length;j++)
            for(var i=0;i<data.length;i++)
                if(data[i].id_project==id_project[j])
                    generateElement(data[i]);



    }
    
    
    todo.remove = function() {
        var tempData = {
            id : id,
        };
        $.ajax({
            url:'index.php?r=home%2Fdelete',
            type: "post",
            cache:false,
            data: tempData,
            success:function () {
                $("#" + defaults.taskId + id).remove();
            }
        });

    }
    todo.update=function () {
        var inputs = $("#w0 :input"),
            errorMessage = "You did not fill one of the fields",
            name, id_user, id_project, description, priority, start_at, end_at,tempData;

        name = inputs[1].value;
        id_user = inputs[2].value;
        id_project = inputs[3].value;
        description = inputs[4].value;
        priority = inputs[5].value;
        start_at = inputs[6].value;
        end_at = inputs[7].value;

        tempData = {
            id : id,
            name: name,
            id_user:id_user,
            id_project:id_project,
            description:description,
            priority:priority,
            start_at:start_at,
            end_at:end_at
        };

        $.ajax({
            url:'index.php?r=home%2Fupdate',
            type: "post",
            cache:false,
            data: tempData,
            success:function (data) {
                var tasks=$.parseJSON(data);
                $("#" + defaults.taskId + id).remove();
                generateElement(tasks);
            }
        });
    }
    todo.add = function() {



        var inputs = $("#w0 :input"),
            errorMessage = "You did not fill one of the fields",
            name, id_user, id_project, description, priority, start_at, end_at,tempData;

        if (inputs.length !== 11) {
            return;
        }
        name = inputs[1].value;
        id_user = inputs[2].value;
        id_project = inputs[3].value;
        description = inputs[4].value;
        priority = inputs[5].value;
        start_at = inputs[6].value;
        end_at = inputs[7].value;


        if (!name || !id_user || !id_project || !priority || !start_at || !end_at) {
            alert(errorMessage);
            return;
        }

        //id = new Date().getTime();

        tempData = {
            id : data.length-1,
            task_status: "1",
            name: name,
            id_user:id_user,
            id_project:id_project,
            description:description,
            priority:priority,
            start_at:start_at,
            end_at:end_at
        };


        $.ajax({
            url:'index.php?r=home%2Ftaskscreate',
            type: "post",
            cache:false,
            data: tempData,
        }).done(function(data) {
            var tasks=$.parseJSON(date);
            $.each(tasks, function(key, value) {
                if(value.flag){
                    $('#modal').modal('hide');
                }else{
                    $('#w0').data('yiiActiveForm').submitting = true;

                    $('#w0').yiiActiveForm('validate');
                }
            });

        });






        data[data.length-1] = tempData;

        //localStorage.setItem("todoData", JSON.stringify(data));

        generateElement(tempData);

        inputs[0].value = "";
        inputs[1].value = "";
        inputs[2].value = "";
        inputs[3].value = "";
        inputs[4].value = "";
        inputs[5].value = "";
        inputs[6].value = "";
        inputs[7].value = "";

    };

    todo.clear = function () {
        data = {};
        localStorage.setItem("todoData", JSON.stringify(data));
        $("." + defaults.todoTask).remove();
    };

})(todo, data, jQuery);