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



    <?php /*GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'email:email',
            'auth_key',
            'password_hash',
            // 'created_at',
            // 'updated_at',
            // 'status',
            // 'color',
            // 'bithday',
            // 'phone',
            // 'country_id',
            // 'city',
            // 'zip',
            // 'address',
            // 'avatar',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);*/ ?>
</div>
