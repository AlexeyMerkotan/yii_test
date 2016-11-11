

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

$(document).on('change','#task-id_user',function () {
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


});

var todo = todo || {},
    data = JSON.parse(localStorage.getItem("todoData"));

data = data || {};

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

        $.each(data, function (index, params) {
            generateElement(params);
        });

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
                        object = data[id];

                    // Removing old element
                    removeElement(object);

                    // Changing object code
                    object.code = index;

                    // Generating new element
                    generateElement(object);

                    // Updating Local Storage
                    data[id] = object;
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
                    object = data[id];

                // Removing old element
                removeElement(object);

                // Updating local storage
                delete data[id];
                localStorage.setItem("todoData", JSON.stringify(data));

                // Hiding Delete Area
                $("#" + defaults.deleteDiv).hide();
            }
        })

    };


    var clicks=function (params) {
        clean();
        $('.btn-success').hide();
        $('.btn-primary').show();
        $('.btn-danger').show();
        $('#modal').modal('show')
            .find('#modal-content')
            .load($(this).attr('data-target'));
    }

    // Add Task
    var generateElement = function(params){
        var parent = $(codes[params.code]),
            wrapper;

        if (!parent) {
            return;
        }

        wrapper = $("<div id='"+(defaults.taskId + params.id)+"' class='"+defaults.todoTask+" ' data='"+params.id+"'></div>").appendTo(parent);

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

    todo.add = function() {

        $('#modal').modal('hide');

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

        id = new Date().getTime();

        tempData = {
            id : id,
            code: "1",
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
            alert(data);
        });
        //data[id] = tempData;

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