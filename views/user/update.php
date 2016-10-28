<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'User',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-10 col-sm-10 col-xs-10">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>





        </div>
    <?php $project = \app\models\Project::find()->all(); ?>
        <div class="col-md-2 col-sm-2 col-xs-2">
                <h3>Project</h3>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <?php foreach ($project as $value):?>
                        <?php $customer = \app\models\UserProject::find()
                            ->where(['id_user' => $_GET['id'],
                            'id_project' => $value->id])
                            ->one();?>
                        <?php if($customer):?>
                        <div class="checkbox" >
                            <label>
                                <input class="projection" type="checkbox" onclick="Id_user(<?=$_GET['id']?>)" value="<?=$value->id?>" checked> <?=$value->name;?>
                            </label>
                        </div>
                            <?php else :?>
                            <div class="checkbox" >
                                <label>
                                    <input class="projection" type="checkbox"  onclick="Id_user(<?=$_GET['id']?>)" value="<?=$value->id?>"> <?=$value->name;?>
                                </label>
                            </div>
                            <?php endif;?>
                    <?php endforeach; ?></div>
    </div>
    </div>

</div>
<script>function Id_user(id_user){
        if($(this).is(":checked")){
            var selected=$(this).val();
            $.get('index.php?r=user%2Faddproject',{'id':selected},function(data){
                alert("Project add to user " + selected);
            });
        } else {
            var selected=$(this).val();
            $.get('index.php?r=user%2Fremoveproject',{'id':selected},function(data){
                alert("Project remove to user " + selected);
            });
        }
    alert(id_user);
    }</script>
