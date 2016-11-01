<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'email:email',
            [
                'attribute'=>'status',
                'label'=>'Status',
                'value' => function ($data) {
                        return date('Y-m-d',$data->created_at);
                },
            ],
            [
                'attribute'=>'status',
                'label'=>'Status',
                'value' => function ($data) {
                    return date('Y-m-d',$data->updated_at);;
                },
            ],
            [
                'attribute'=>'status',
                'label'=>'Status',
                'value' => function ($data) {
                    if($data->status==1)
                        return 'panding';
                    if($data->status==0)
                        return 'enabled';
                    if($data->status==2)
                        return 'blocked';
                },
            ],
            [
                'attribute'=>'role',
                'label'=>'Role',
                'value' => function ($data) {
                    if($data->role==1)
                        return 'admin';
                    if($data->role==0)
                        return 'user';
                },
            ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
