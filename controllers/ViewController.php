<?php

namespace app\controllers;

use app\models\Project;
use Yii;
use app\models\User;
use app\models\UserProject;
use app\models\Calendar;
use yii\helpers\Json;


class ViewController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionChechviewproject(){
        $data = Json::decode(stripslashes(\Yii::$app->request->post('select')));

        $calendar=Calendar::find()->where(['id_project'=>$id])->all();
        $arr=[];
        foreach ($calendar as $item) {
            foreach ($select as $value){
                if($item->id_project==$value){
                    $project = Project::findOne($item->id_project);
                    $user=User::findOne($item->id_user);
                    $array = [
                        'project'=>$project->name,
                        'id'=>$item->id,
                        'start_at'=> date('Y-m-d',$item->start_at),
                        'end_at'=>date('Y-m-d',$item->end_at),
                        'color'=>$user->color,

                    ];
                }
                $arr[]=$array;
            }
        }
        echo Json::encode($arr);

        /*$calendar=Calendar::find()->where(['id_project'=>$id])->all();
        $arr=[];
        foreach ($calendar as $item) {
            $project = Project::findOne($item->id_project);
            $user=User::findOne($item->id_user);
            $array = [
                'project'=>$project->name,
                'id'=>$item->id,
                'start_at'=> date('Y-m-d',$item->start_at),
                'end_at'=>date('Y-m-d',$item->end_at),
                'color'=>$user->color,

            ];
            $arr[]=$array;
        }*/

    }

    /*public function actionChechviewproject($id){
        $calendar=Calendar::find()->where(['id_project'=>$id])->all();
        $arr=[];
        foreach ($calendar as $item) {
            $project = Project::findOne($item->id_project);
            $user=User::findOne($item->id_user);
            $array = [
                'project'=>$project->name,
                'id'=>$item->id,
                'start_at'=> date('Y-m-d',$item->start_at),
                'end_at'=>date('Y-m-d',$item->end_at),
                'color'=>$user->color,

            ];
            $arr[]=$array;
        }
        echo Json::encode($arr);
    }*/


    //checkbox filter delete project
    public function actionChechproject($id){

        $user=Calendar::find()->where(['id_project'=>$id])->all();
        $arr=[];
        foreach ($user as $item) {
            $array = [
                'id'=>$item->id,
            ];
            $arr[]=$array;
        }
        echo Json::encode($arr);

    }
    //checkbox filter view user
    public function actionChechviewuser($id){
        $calendar=Calendar::find()->where(['id_user'=>$id])->all();
        $arr=[];
        foreach ($calendar as $item) {
            $project = Project::findOne($item->id_project);
            $user=User::findOne($item->id_user);
            $array = [
                'project'=>$project->name,
                'id'=>$item->id,
                'start_at'=> date('Y-m-d',$item->start_at),
                'end_at'=>date('Y-m-d',$item->end_at),
                'color'=>$user->color,

            ];
            $arr[]=$array;
        }
        echo Json::encode($arr);
    }


    //checkbox filter delete project
    public function actionChechuser($id){

        $user=Calendar::find()->where(['id_user'=>$id])->all();
        $arr=[];
        foreach ($user as $item) {
            $array = [
                'id'=>$item->id,
            ];
            $arr[]=$array;
        }
        echo Json::encode($arr);

    }



    //select project
    public function actionSelect($select){


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
