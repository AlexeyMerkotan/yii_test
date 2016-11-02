<?php

namespace app\controllers;


use app\models\Project;
use app\models\User;
use app\models\UserProject;
use app\models\Calendar;
use yii\helpers\Json;


class ModelviewController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }




    //select project
    public function actionSelect($select){

        if((integer)$select){
            $query=UserProject::find()->all();
            $arr=[];
            foreach ($query as $item) {
                if($item->id_user==$select){
                    $project=Project::findOne($item->id_project);
                    $array = [
                        'id'=>$project->id,
                        'name'=>$project->name,
                    ];
                    $arr[]=$array;
                }
            }
            echo Json::encode($arr);
        }
    }

    //save data calendar
    public function actionCreate(){


        $calendar = new Calendar();
        $calendar->load(\Yii::$app->request->post(),'');
        $calendar->save();
        if(!$calendar->errors){
            $project = Project::findOne($calendar->id_project);
            $user=User::findOne($calendar->id_user);
            $array = [
                'flag'=>true,
                'id'=>$calendar->id,
                'project'=>$project->name,
                'start_at'=>date('Y-m-d\TH:i:s\Z',$calendar->start_at),
                'end_at'=>date('Y-m-d\TH:i:s\Z',$calendar->end_at),
                'color'=>$user->color,
            ];
            $arr[]=$array;
            echo Json::encode($arr);
        }else {
            $var = [
                'flag' => false,
            ];
            echo Json::encode($var);
        }
    }


    //save update calendaar
    public function actionUpdate(){

        $calendar=Calendar::findOne(\Yii::$app->request->post('id'));
        $calendar->load(\Yii::$app->request->post(),'');
        $calendar->save();
        $user=User::findOne($calendar->id_user);
        $project=Project::findOne($calendar->id_project);
        $array=['id'=> $calendar->id,
            'id_user'=> $calendar->id_user,
            'id_project'=> $calendar->id_project,
            'project'=>$project->name,
            'start_at'=> date('Y-m-d\TH:i:s\Z',$calendar->start_at),
            'end_at'=> date('Y-m-d\TH:i:s\Z',$calendar->end_at),
            'color'=>$user->color,];
        $arr[]=$array;
        echo  Json::encode($arr);
    }



    //view update calendar
    public function actionDetermine($id){
        if((integer)$id){
            $model = Calendar::findOne($id);
            $array = [
                'id'=>$model->id,
                'id_user'=>$model->id_user,
                'id_project'=>$model->id_project,
                'start_at'=>date('Y-m-d\TH:i:s\Z',$model->start_at),
                'end_at'=>date('Y-m-d\TH:i:s\Z',$model->end_at),
                'comment'=>$model->comment,
            ];
            echo Json::encode($array);
        }
    }



    //delete date calendar
    public function actionDelete()
    {
        Calendar::findOne(\Yii::$app->request->post('id'))->delete();

    }


}
