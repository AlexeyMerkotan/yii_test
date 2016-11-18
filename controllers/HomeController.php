<?php

namespace app\controllers;


use app\models\Project;
use app\models\UserProject;
use Yii;
use app\models\User;
use app\models\Calendar;
use app\models\Task;
use yii\bootstrap\Modal;
use \yii\helpers\ArrayHelper;
use yii\helpers\Json;


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
    public function actionTasks(){

        if(!Yii::$app->user->isGuest) {

            if(Yii::$app->user->identity->role==User::admin){
                $task=new Task();
                $project=Project::find()->all();
                $authors = User::find()->all();
                $items = ArrayHelper::map($authors,'id','name');
                return $this->render('tasks',[
                    'project' => $project,
                    'items' => $items,
                    'task'  =>  $task,

                ]);
            }else{
                $task=new Task();
                $id_user=Yii::$app->user->identity->id;
                $project=Project::find()->where(['id_user' => $id_user])->all();
                $authors = User::find()->all();
                $items = ArrayHelper::map($authors,'id','name');
                return $this->render('tasks',[
                    'project' => $project,
                    'items' => $items,
                    'task'  =>  $task,

                ]);
            }

        } else{
            return $this->redirect(['/login']);
        }

    }

    public function actionTaskscreate(){
        if(Yii::$app->user->identity->role==User::admin)
        {

            $task=new Task();
            $task->load(\Yii::$app->request->post(),'');
            $task->task_status=\Yii::$app->request->post('task_status');
            $task->save();
            if(!$task->errors){
                $array = ['flag'=>true,];
                echo Json::encode($array);
            }else {
                $array = ['flag' => false,];
                echo Json::encode($array);
            }
        }
    }

    public  function actionTasksview()
    {
        if(Yii::$app->user->identity->role==User::admin)
        {
            $task=Task::find()->all();
            $arr=[];
            foreach ($task as $value)
            {
                $array = [
                    'id'=>$value->id,
                    'name'=>$value->name,
                    'id_user'=>$value->id_user,
                    'id_project'=>$value->id_project,
                    'description'=>$value->description,
                    'priority'=>$value->priority,
                    'task_status'=>$value->task_status,
                    'start_at'=>date('Y-m-d\TH:i:s\Z',$value->start_at),
                    'end_at'=>date('Y-m-d\TH:i:s\Z',$value->end_at),
                ];
                $arr[]=$array;
            }
            echo Json::encode($arr);
        }else{
            $task=Task::find()->where(['id_user' => Yii::$app->user->identity->id])->all();
            $arr=[];
            foreach ($task as $value)
            {
                $array = [
                    'id'=>$value->id,
                    'name'=>$value->name,
                    'id_user'=>$value->id_user,
                    'id_project'=>$value->id_project,
                    'description'=>$value->description,
                    'priority'=>$value->priority,
                    'task_status'=>$value->task_status,
                    'start_at'=>date('Y-m-d\TH:i:s\Z',$value->start_at),
                    'end_at'=>date('Y-m-d\TH:i:s\Z',$value->end_at),
                ];
                $arr[]=$array;
            }
            echo Json::encode($arr);
        }


    }

    public function actionDetermine($id){
        if(Yii::$app->user->identity->role==User::admin) {
            if ((integer)$id) {
                $task = Task::findOne($id);
                $array = [
                    'id' => $task->id,
                    'name' => $task->name,
                    'id_user' => $task->id_user,
                    'id_project' => $task->id_project,
                    'description' => $task->description,
                    'priority' => $task->priority,
                    'start_at' => date('Y-m-d\TH:i:s\Z', $task->start_at),
                    'end_at' => date('Y-m-d\TH:i:s\Z', $task->end_at),
                ];
                echo Json::encode($array);
            }
        }
    }

    public function actionUpdate(){
        if(Yii::$app->user->identity->role==User::admin) {
            $task = Task::findOne(\Yii::$app->request->post('id'));
            $task->load(\Yii::$app->request->post(), '');
            $task->save();
            echo Json::encode($task);
        }
    }

    //delete date calendar
    public function actionDelete(){
        if(Yii::$app->user->identity->role==User::admin)
            Task::findOne(\Yii::$app->request->post('id'))->delete();
    }

    public function actionTaskstatus($id, $status)
    {
        $task=Task::findOne($id);
        $task->task_status=$status;
        $task->start_at=date('Y-m-d H:m',$task->start_at);
        $task->end_at=date('Y-m-d H:m',$task->end_at);
        $task->save();
    }



}
