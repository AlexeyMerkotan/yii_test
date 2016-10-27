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

    <div class="form-group field-calendar-id_user required has-error __web-inspector-hide-shortcut__">
        <label class="control-label" for="calendar-id_user">Id User</label>
        <select id="calendar-id_user" class="form-control" name="Calendar[id_user]">
            <option value="prompt">Select...</option>
        </select>

        <p class="help-block help-block-error">Id User must be an integer.</p>
    </div>


    <div class="form-group field-calendar-id_project required has-error">
        <label class="control-label" for="calendar-id_project">Id Project</label>
        <select id="calendar-id_project" class="form-control" name="Calendar[id_project]">
            <option value="prompt">Select...</option>
        </select>

        <p class="help-block help-block-error">Id Project must be an integer.</p>
    </div>


    <?= $form->field($calendar, 'start_at', ['options' => ['class' => 'hidden1']])->textInput(['value' => !empty($calendar->start_at) ? date('Y-m-d', $calendar->start_at) : null]) ?>

    <?= $form->field($calendar, 'start_at')->widget(DatePicker::classname(), [
        'clientOptions' => ['changeMonth' => true, 'changeYear' => true, 'yearRange' => $datePickerRange, 'altFormat' => 'yy-mm-dd', 'altField' => '#calendar-start_at'],
        'options' => ['class' => 'form-control', 'readonly' => true, 'id' => 'date-picker1-update', 'name' => 'date-picker1-update']
    ]) ?>



    <?= $form->field($calendar, 'end_at', ['options' => ['class' => 'hidden1']])->textInput(['value' => !empty($calendar->end_at) ? date('Y-m-d', $calendar->end_at) : null]) ?>

    <?= $form->field($calendar, 'end_at')->widget(DatePicker::classname(), [
        'clientOptions' => ['changeMonth' => true, 'changeYear' => true, 'yearRange' => $datePickerRange, 'altFormat' => 'yy-mm-dd', 'altField' => '#calendar-end_at'],
        'options' => ['class' => 'form-control', 'readonly' => true, 'id' => 'date-picker2-update', 'name' => 'date-picker2-update']
    ]) ?>






    <?= $form->field($calendar, 'comment')->textarea([
        'id' => 'calendar-comment-update',
        'rows' => 6]) ?>



    <button type="button" class="btn btn-primary">Update</button>

    <button type="button" class="btn btn-danger">Delete</button>




    <?php ActiveForm::end(); ?>

    <?php yii\bootstrap\Modal::end(); ?>




    <div class="row">
        <div class="col-md-10 col-sm-10 col-xs-10">
            <?= \yii2fullcalendar\yii2fullcalendar::widget(array(  'events' => $events,
                'id' => 'calendar',
                'options' => ['enctype' => 'multipart/form-data'],
                'clientOptions' => [
                    'eventClick' => TRUE,
                    'eventClick'=>new \yii\web\JsExpression('function(event, element) {    
                                //alert(\'Event: \' + event.id);
                                id=event.id;          
                }'),
                ],
            ));?>
        </div>
        <div class="col-md-2 col-sm-2 col-xs-2">    <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <?php
                    foreach ($model as $value):?>
                        <div class="checkbox">
                            <label>
                                <input  class="user" type="checkbox"  onclick="user(<?=$value->id?>)" value="<?=$value->id?>"> <?=$value->name;?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12"><?php
                    foreach ($project as $value):?>
                        <div class="checkbox">
                            <label>
                                <input  class="project" type="checkbox"  onclick="project(<?=$value->id?>)" value="<?=$value->id?>"> <?=$value->name;?>
                            </label>
                        </div>
                    <?php endforeach; ?></div>
            </div></div>
    </div>










</div>
