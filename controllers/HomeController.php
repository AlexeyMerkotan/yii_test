<?php

namespace app\controllers;


use app\models\Project;
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

            $query = Calendar::find()->all();


            $events = array();
            foreach ($query as $userproject){
                $project = Project::findOne($userproject->id_project);

                $user = User::findOne($userproject->id_user);
                $Event = new \yii2fullcalendar\models\Event();
                $Event->id = $userproject->id;
                $Event->title = " Project(".$project->name.")";
                $Event->color=$user->color;
                $Event->start = date('Y-m-d\TH:i:s\Z',$userproject->start_at);
                $Event->end = date('Y-m-d\TH:i:s\Z',$userproject->end_at);
                $events[] = $Event;
            }
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
        }else{
            return $this->redirect(['/login']);
        }
    }

    public function actionProfile(){

        if(!Yii::$app->user->isGuest) {
            $model = User::findOne(Yii::$app->user->identity->id);
            if($model->load(Yii::$app->request->post()) && $model->save()){
                return $this->redirect(['index']);
            }else
                return $this->render('profile',[ 'model' => $model,]);
        }
        else{
            return $this->redirect(['/login']);
        }

    }


}
