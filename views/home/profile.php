<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\color\ColorInput;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = 'Profile';
$datePickerRange = (date('Y') - 100) . ':' . date('Y');
?>
<div class="users-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'color')->widget(ColorInput::classname(), [
        'options' => ['placeholder' => 'Select color ...'],
    ]);
    ?>

    <?php if($model->avatar!=NULL) :?>
    <?= Html::img($model->avatar, ['alt' => $model->avatar]) ?>
    <?php endif;?>

    <?= $form->field($model, 'avatar')->fileInput()  ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'auth_key')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'password_2')->passwordInput() ?>

    <?php //$form->field($model, 'created_at')->textInput() ?>

    <?php //$form->field($model, 'updated_at')->textInput() ?>

    <?php //$form->field($model, 'status')->textInput() ?>

    <?php //$form->field($model, 'color')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'bithday', ['options' => ['class' => 'hidden']])->textInput(['value' => !empty($model->bithday) ? date('Y-m-d', $model->bithday) : null]) ?>

    <?= $form->field($model, 'bithday')->widget(DatePicker::classname(), [
        'clientOptions' => ['changeMonth' => true, 'changeYear' => true, 'yearRange' => $datePickerRange, 'altFormat' => 'yy-mm-dd', 'altField' => '#user-bithday'],
        'options' => ['class' => 'form-control', 'readonly' => true, 'id' => 'date-picker', 'name' => 'date-picker']
    ]) ?>

    <?= $form->field($model, 'phone')->textInput() ?>

    <?php
    $country = \app\models\Country::find()->all();
    $items = \yii\helpers\ArrayHelper::map($country,'id','name');
    ?>

    <?= $form->field($model, 'country_id')->dropDownList($items,[
        'prompt' => 'Select...'
    ]);?>


    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'zip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Sign up') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
