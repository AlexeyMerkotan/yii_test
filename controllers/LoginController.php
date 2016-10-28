<?php

namespace app\controllers;



use Yii;
use app\models\LoginSearch;


class LoginController extends \yii\web\Controller
{
    public function actionIndex()
    {

        if (!Yii::$app->user->isGuest) {
            return $this->redirect('/home');
        } else {
            $model = new LoginSearch();

            if ($model->load(Yii::$app->request->post()) && $model->login())
                return $this->redirect(['/home']);
            else
                return $this->render('index', ['model' => $model]);

        }

    }

    public  function actionLogout(){

        Yii::$app->user->logout();

        return $this->redirect(['index']);

    }

}
