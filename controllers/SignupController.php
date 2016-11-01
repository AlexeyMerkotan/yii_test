<?php

namespace app\controllers;

use Yii;
use app\models\User;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


/**
 * SignupController implements the CRUD actions for Users model.
 */
class SignupController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    public function actionIndex()
    {
        if(Yii::$app->user->isGuest){
            $model = new User();
            if ($model->load(Yii::$app->request->post())&& Yii::$app->user->isGuest) {

                $model->setPassword($model->password,$model->password_2);

                $model->generateAuthKey();

                $model->status();

                if (Yii::$app->request->isPost){

                    if(UploadedFile::getInstance($model, 'avatar'))
                    {
                        $avatar = UploadedFile::getInstance($model, 'avatar');

                        $type=substr($avatar->type,6);

                        $today = new \DateTime('now');

                        $avatar->saveAs('avatar/' . $today->date . '.' . $type);

                        $model->avatar='avatar/' . $today->date . '.' . $type;
                    }
                    else
                        $model->avatar='NULL';
                }

                if($model->save())
                    return $this->redirect(['/login/index']);

            } else {

                return $this->render('index', [
                    'model' => $model,
                ]);
            }
        }
        else{
            return $this->redirect(['/home']);
        }


    }




}
