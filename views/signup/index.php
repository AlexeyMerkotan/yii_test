<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SignupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Calendar');
?>
<div class="users-index">

    <h1>Sign up</h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= $this->render('_form', ['model' => $model,]) ?>


</div>
