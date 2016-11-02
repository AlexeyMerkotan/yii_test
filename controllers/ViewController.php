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
        if(Yii::$app->user->identity->role==User::admin)
            $id_user = Json::decode(\Yii::$app->request->post('id_user'), TRUE);
        else
            $id_user=Yii::$app->user->identity->id;
        $id_project = Json::decode(\Yii::$app->request->post('id_project'), TRUE);
        $calendar=Calendar::find()->where(['and',['in', 'id_project', $id_project],['in','id_user', $id_user]])->all();
        $arr=[];
        foreach ($calendar as $item){
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
