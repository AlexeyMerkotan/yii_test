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
use \yii2fullcalendar\yii2fullcalendar;






$this->title = 'Home';
$datePickerRange = (date('Y') - 100) . ':' . date('Y');
?>
<div class="site-login">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if(Yii::$app->user->identity->role=="1"):
        echo $this->render('model', ['calendar' => $calendar, 'items' => $items,]); ?>
    <?php endif ;?>





    <div class="row">
        <div class="col-md-10 col-sm-10 col-xs-10">
            <?= yii2fullcalendar::widget(array(  'events' => $events,
                'id' => 'calendar',
                'options' => ['enctype' => 'multipart/form-data'],
                'clientOptions' => [
                    'eventClick' => TRUE,
                    'eventClick'=>new \yii\web\JsExpression('function(event, element) {    
                                id=event.id;          
                }'),


                ],
            ));?>
        </div>

        <?php
        if(Yii::$app->user->identity->role=="1")
            echo $this->render('_admin', ['project' => $project, 'model' => $model,]);
        else
            echo $this->render('_user' ,['project' => $project,]);
        ?>
    </div>










</div>
