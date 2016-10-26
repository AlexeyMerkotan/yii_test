<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;


/* @var $this yii\web\View */
/* @var $model app\models\Project */
/* @var $form yii\widgets\ActiveForm */
$datePickerRange = (date('Y') - 100) . ':' . date('Y');

?>

<div class="project-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>


    <?= $form->field($model, 'start_at', ['options' => ['class' => 'hidden1']])->textInput(['value' => !empty($model->start_at) ? date('Y-m-d', $model->start_at) : null]) ?>

    <?= $form->field($model, 'start_at')->widget(DatePicker::classname(), [
        'clientOptions' => ['changeMonth' => true, 'changeYear' => true, 'yearRange' => $datePickerRange, 'altFormat' => 'yy-mm-dd', 'altField' => '#project-start_at'],
        'options' => ['class' => 'form-control', 'readonly' => true, 'id' => 'date-picker', 'name' => 'date-picker']
    ]) ?>





    <?= $form->field($model, 'end_at', ['options' => ['class' => 'hidden1']])->textInput(['value' => !empty($model->end_at) ? date('Y-m-d', $model->end_at) : null]) ?>

    <?= $form->field($model, 'end_at')->widget(DatePicker::classname(), [
        'clientOptions' => ['changeMonth' => true, 'changeYear' => true, 'yearRange' => $datePickerRange, 'altFormat' => 'yy-mm-dd', 'altField' => '#project-end_at'],
        'options' => ['class' => 'form-control', 'readonly' => true, 'id' => 'date-picker2', 'name' => 'date-picker2']
    ]) ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
