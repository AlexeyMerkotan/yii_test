<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;



AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>

    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php





    NavBar::begin([
        'brandLabel' => 'Yii Test',
        'brandUrl' => ['/signup/index'],
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/home'],'visible' => !Yii::$app->user->isGuest],

            [ 'label' => 'Tasks', 'url' => ['/home/tasks'],'visible' => !Yii::$app->user->isGuest],

            ['label' => 'User', 'url' => ['/user'],'visible' => !Yii::$app->user->isGuest and Yii::$app->user->identity->role==\app\models\User::admin],

            ['label' => 'Project', 'url' => ['/project'],'visible' => !Yii::$app->user->isGuest and Yii::$app->user->identity->role==\app\models\User::admin],


            [ 'label' => 'Sign up', 'url' => ['/signup'],'visible' => Yii::$app->user->isGuest],

            [ 'label' => 'Profile', 'url' => ['/home/profile'],'visible' => !Yii::$app->user->isGuest],

            Yii::$app->user->isGuest ?
            [
                'label' => 'Login', 'url' => ['/login']
            ]

             :
            [
                'label' => 'Logout ('. Yii::$app->user->identity->email . ')', 'url' => ['/login/logout']
            ]


        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
