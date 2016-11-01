<?php

namespace app\controllers;


use app\models\Project;
use app\models\UserProject;
use Yii;
use app\models\User;
use app\models\Calendar;
use \yii\helpers\ArrayHelper;


class HomeController extends \yii\web\Controller
{
    public function actionIndex()
    {
        if(!Yii::$app->user->isGuest) {
            $calendar = new Calendar();
            if(Yii::$app->user->identity->role==User::admin) {


                $events = $calendar->admin();

                $model=User::find()->all();
                $project=Project::find()->all();
                $authors = User::find()->all();
                $items = ArrayHelper::map($authors,'id','name');
                return $this->render('index',['events'=>$events,
                    'calendar' => $calendar,
                    'model' => $model,
                    'project' => $project,
                    'items'  => $items,
                ]);
            }
            else{

                $events = $calendar->user();
                $project=Project::find()
                    ->distinct()
                    ->innerJoin('calendar', '`project`.`id` = `calendar`.`id_project`')
                    ->where(['id_user'=>Yii::$app->user->identity->id])->all();
                $authors = User::find()->all();
                $items = ArrayHelper::map($authors,'id','name');
                return $this->render('index',['events'=>$events,
                    'calendar' => $calendar,
                    'project' => $project,
                    'items'  => $items,
                ]);
            }






        }else{
            return $this->redirect(['/login']);
        }
    }

    public function actionProfile(){

        if(!Yii::$app->user->isGuest) {
            $model = User::findOne(Yii::$app->user->identity->id);
            if($model->load(Yii::$app->request->post())){
                $model->setPassword($model->password,$model->password_2);
                if($model->save())
                    return $this->redirect(['index']);
            }else
                return $this->render('profile',[ 'model' => $model,]);
        }
        else{
            return $this->redirect(['/login']);
        }

    }


}
