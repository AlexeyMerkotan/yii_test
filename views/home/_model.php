<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\jui\DatePicker;
use app\models\User;
use kartik\datetime\DateTimePicker;


/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
$datePickerRange = (date('Y') - 100) . ':' . date('Y');
?>

<?php Modal::begin([
    'header' => 'Task',
    'id' => 'modal',
    'size' => 'modal-md',

]);
?>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($task, 'name')->textInput(); ?>

<?= $form->field($task, 'id_user')->dropDownList($items,[
    'prompt' => 'Select...'
]);?>

<?= $form->field($task, 'id_project')->dropDownList([
    'prompt' => 'Select...'
]);?>

<?= $form->field($task, 'description')->textarea(['rows' => 6]) ?>

<?= $form->field($task, 'priority')->dropDownList([
    'prompt' => 'Select...',
    '0' => 'Very High',
    '1' => 'High',
    '2'=>'Medium',
    '3' => 'Low',
    '4'=>'Very Low'
]);?>

<?=  $form->field($task, 'start_at')->widget(DateTimePicker::className(),[
    'options' => ['placeholder' => 'Start time...'],
    'pluginOptions' => ['autoclose' => true],
]); ?>

<?=  $form->field($task, 'end_at')->widget(DateTimePicker::className(),[
    'options' => ['placeholder' => 'Start time...'],
    'pluginOptions' => ['autoclose' => true],

]); ?>



<button type="button" class="btn btn-success" onclick="todo.add();">Create</button>

<button type="button" class="btn btn-primary">Update</button>

<button type="button" class="btn btn-danger" data-dismiss="modal">Delete</button>


<?php ActiveForm::end(); ?>

<?php Modal::end(); ?>

