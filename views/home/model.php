<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\jui\DatePicker;
use app\models\User;


/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
$datePickerRange = (date('Y') - 100) . ':' . date('Y');
?>
<?php Modal::begin([
    'header' => 'Cобытие',
    'id' => 'modal',
    'size' => 'modal-md',
]);
?>
<?php $form = ActiveForm::begin(); ?>


<?= $form->field($calendar, 'id_user')->dropDownList($items,[
    'prompt' => 'Select...'
]);?>

<?= $form->field($calendar, 'id_project')->dropDownList([
    'prompt' => 'Select...'
]);?>


<?= $form->field($calendar, 'start_at', ['options' => ['class' => 'hidden']])->textInput(['value' => !empty($calendar->start_at) ? date('Y-m-d', $calendar->start_at) : null]) ?>

<?= $form->field($calendar, 'start_at')->widget(DatePicker::classname(), [
    'clientOptions' => ['changeMonth' => true, 'changeYear' => true, 'yearRange' => $datePickerRange, 'altFormat' => 'yy-mm-dd', 'altField' => '#calendar-start_at'],
    'options' => ['class' => 'form-control', 'readonly' => true, 'id' => 'date-picker1-update', 'name' => 'date-picker1-update']
]) ?>


<?= $form->field($calendar, 'end_at', ['options' => ['class' => 'hidden']])->textInput(['value' => !empty($calendar->end_at) ? date('Y-m-d', $calendar->end_at) : null]) ?>

<?= $form->field($calendar, 'end_at')->widget(DatePicker::classname(), [
    'clientOptions' => ['changeMonth' => true, 'changeYear' => true, 'yearRange' => $datePickerRange, 'altFormat' => 'yy-mm-dd', 'altField' => '#calendar-end_at'],
    'options' => ['class' => 'form-control', 'readonly' => true, 'id' => 'date-picker', 'name' => 'date-picker']
]) ?>


<?= $form->field($calendar, 'comment')->textarea(['rows' => 6]) ?>


<button type="button" class="btn btn-success" data-dismiss="modal">Create</button>

<button type="button" class="btn btn-primary">Update</button>

<button type="button" class="btn btn-danger" data-dismiss="modal">Delete</button>



<?php ActiveForm::end(); ?>

<?php Modal::end(); ?>