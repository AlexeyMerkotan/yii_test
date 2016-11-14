<?php
/* @var $this yii\web\View */

use yii\helpers\Html;


$this->title = 'Task';
?>
<h1><?= Html::encode($this->title) ?></h1>


<?php if(Yii::$app->user->identity->role=="1"):
    echo $this->render('_model', ['task' => $task,'items' => $items,]); ?>
<?php endif ;?>
<div class="row">
    <div class="col-md-10 col-sm-10 col-xs-10">
        <div class="task-list task-container" id="pending">
            <h3>Pending</h3>
        </div>

        <div class="task-list task-container" id="inProgress">
            <h3>In Progress</h3>
        </div>

        <div class="task-list task-container" id="completed">
            <h3>Completed</h3>
        </div>
    </div>

<div class="col-md-2 col-sm-2 col-xs-2" style="border: 1px solid ">
    <div  class="col-md-12 col-sm-12 col-xs-12" style="padding-top: 15px;">
        <div class="row">
            <div class="col-md-6 col-md-offset-2">
                <button type="button" class="btn btn-info" id="task">New Task</button>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <h3>Project</h3>
            <?php foreach ($project as $value):?>
                <div class="checkbox project">
                    <label>
                        <input type="checkbox"   value="<?=$value->id?>" checked> <?=$value->name;?>
                    </label>
                </div>
            <?php endforeach; ?></div>

    </div>
    <div  class="col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 15px;">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <button type="button" class="btn btn-default" onclick="todo.filter();">Filter</button>
            </div>
        </div>

    </div>
</div>
</div>


<?php
$script = <<< JS
    $(".task-container").droppable();
    $(".todo-task").draggable({ revert: "valid", revertDuration:200 });
    todo.init();
JS;
//маркер конца строки, обязательно сразу, без пробелов и табуляции
$this->registerJs($script);
?>
