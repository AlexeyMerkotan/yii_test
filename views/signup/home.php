<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\color\ColorInput;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\jui\DatePicker;
use app\models\User;
use \yii\helpers\ArrayHelper;





$this->title = 'Home';
$datePickerRange = (date('Y') - 100) . ':' . date('Y');
?>
<div class="site-login">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    yii\bootstrap\Modal::begin([
        'header' => 'Cобытие',
        'id' => 'modal',
        'size' => 'modal-md',
    ]);
    ?>
    <?php $form = ActiveForm::begin(); ?>



    <?= $form->field($calendar, 'id_user')->dropDownList([
        'prompt' => 'Select...'
    ]);?>

    <?= $form->field($calendar, 'id_project')->dropDownList([
        'prompt' => 'Select...'
    ]);?>


    <?= $form->field($calendar, 'end_at', ['options' => ['class' => 'hidden1']])->textInput(['value' => !empty($calendar->end_at) ? date('Y-m-d', $calendar->end_at) : null]) ?>

    <?= $form->field($calendar, 'end_at')->widget(DatePicker::classname(), [
        'clientOptions' => ['changeMonth' => true, 'changeYear' => true, 'yearRange' => $datePickerRange, 'altFormat' => 'yy-mm-dd', 'altField' => '#calendar-end_at'],
        'options' => ['class' => 'form-control', 'readonly' => true, 'id' => 'date-picker', 'name' => 'date-picker']
    ]) ?>


    <?= $form->field($calendar, 'comment')->textarea(['rows' => 6]) ?>


    <button type="button" class="btn btn-success">Create</button>



    <?php ActiveForm::end(); ?>

    <?php yii\bootstrap\Modal::end(); ?>

    <?php
    yii\bootstrap\Modal::begin([
        'header' => 'Cобытие',
        'id' => 'modal1',
        'size' => 'modal-md',
    ]);
    ?>
    <?php $form = ActiveForm::begin(); ?>



    <?= $form->field($calendar, 'id_user')->dropDownList([
        'prompt' => 'Select...'
    ]);?>

    <?= $form->field($calendar, 'id_project')->dropDownList([
        'prompt' => 'Select...'
    ]);?>


    <?= $form->field($calendar, 'start_at', ['options' => ['class' => 'hidden1']])->textInput(['value' => !empty($calendar->start_at) ? date('Y-m-d', $calendar->start_at) : null]) ?>

    <?= $form->field($calendar, 'start_at')->widget(DatePicker::classname(), [
        'clientOptions' => ['changeMonth' => true, 'changeYear' => true, 'yearRange' => $datePickerRange, 'altFormat' => 'yy-mm-dd', 'altField' => '#calendar-start_at'],
        'options' => ['class' => 'form-control', 'readonly' => true, 'id' => 'date-picker1', 'name' => 'date-picker1']
    ]) ?>



    <?= $form->field($calendar, 'end_at', ['options' => ['class' => 'hidden1']])->textInput(['value' => !empty($calendar->end_at) ? date('Y-m-d', $calendar->end_at) : null]) ?>

    <?= $form->field($calendar, 'end_at')->widget(DatePicker::classname(), [
        'clientOptions' => ['changeMonth' => true, 'changeYear' => true, 'yearRange' => $datePickerRange, 'altFormat' => 'yy-mm-dd', 'altField' => '#calendar-end_at'],
        'options' => ['class' => 'form-control', 'readonly' => true, 'id' => 'date-picker', 'name' => 'date-picker']
    ]) ?>






    <?= $form->field($calendar, 'comment')->textarea(['rows' => 6]) ?>



    <button type="button" class="btn btn-primary">Update</button>

    <button type="button" class="btn btn-danger">Delete</button>




    <?php ActiveForm::end(); ?>

    <?php yii\bootstrap\Modal::end(); ?>



    <?= \yii2fullcalendar\yii2fullcalendar::widget(array(  'events' => $events,'id' => 'calendar',));?>










</div>
