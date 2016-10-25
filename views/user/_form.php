<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use kartik\color\ColorInput;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
$datePickerRange = (date('Y') - 100) . ':' . date('Y');
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([
        '0' => 'enabled',
        '1' => 'pending',
        '2'=>'blocked'
    ]);?>


    <?= $form->field($model, 'color')->widget(ColorInput::classname(), [
        'options' => ['placeholder' => 'Select color ...'],
    ]);
    ?>

    <?= $form->field($model, 'bithday', ['options' => ['class' => 'hidden1']])->textInput(['value' => !empty($model->bithday) ? date('Y-m-d', $model->bithday) : null]) ?>

    <?= $form->field($model, 'bithday')->widget(DatePicker::classname(), [
        'clientOptions' => ['changeMonth' => true, 'changeYear' => true, 'yearRange' => $datePickerRange, 'altFormat' => 'yy-mm-dd', 'altField' => '#user-bithday'],
        'options' => ['class' => 'form-control', 'readonly' => true, 'id' => 'date-picker', 'name' => 'date-picker']
    ]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'country_id')->textInput() ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'avatar')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
