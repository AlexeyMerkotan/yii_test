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
    'header' => 'Event',
    'id' => 'modal',
    'size' => 'modal-md',
]);
?>
<?php $form = ActiveForm::begin(['id'=>'calendar-form']); ?>


<?= $form->field($calendar, 'id_user')->dropDownList($items,[
    'prompt' => 'Select...'
]);?>

<?= $form->field($calendar, 'id_project')->dropDownList([
    'prompt' => 'Select...'
]);?>





<?=  $form->field($calendar, 'start_at')->widget(DateTimePicker::className(),[
    'options' => ['placeholder' => 'Start time...'],
    'pluginOptions' => ['autoclose' => true],
]); ?>

<?=  $form->field($calendar, 'end_at')->widget(DateTimePicker::className(),[
    'options' => ['placeholder' => 'Start time...'],
    'pluginOptions' => ['autoclose' => true],

]); ?>





<?= $form->field($calendar, 'comment')->textarea(['rows' => 6]) ?>


<button type="button" id="create_date" class="btn btn-success">Create</button>

<button type="button" id="update_date" class="btn btn-primary">Update</button>

<button type="button" id="remove_date" class="btn btn-danger" data-dismiss="modal">Delete</button>



<?php ActiveForm::end(); ?>

<?php Modal::end(); ?>