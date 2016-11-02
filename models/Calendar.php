<?php

namespace app\models;

use Yii;
use app\models\Project;
/**
 * This is the model class for table "calendar".
 *
 * @property integer $id
 * @property integer $id_user
 * @property integer $id_project
 * @property integer $start_at
 * @property integer $end_at
 * @property string $comment
 *
 * @property Project $idProject
 * @property User $idUser
 */
class Calendar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%calendar}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'id_project', 'start_at', 'end_at'], 'required'],
            [['id_user', 'id_project'], 'integer'],
            [['comment'], 'string'],
            [['id_project'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['id_project' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],


            [['start_at','end_at'], 'date', 'format' => 'yyyy-MM-dd HH:mm'],

        ];
    }


    public function afterValidate()
    {
        if (!empty($this->start_at)&&!empty($this->end_at)) {
            $this->start_at = strtotime($this->start_at);
            $this->end_at=strtotime($this->end_at);
        }
        return parent::afterValidate();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_user' => Yii::t('app', 'User'),
            'id_project' => Yii::t('app', 'Project'),
            'start_at' => Yii::t('app', 'Start At'),
            'end_at' => Yii::t('app', 'End At'),
            'comment' => Yii::t('app', 'Comment'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'id_project']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }



    public function admin(){
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
        return $events;
    }

    public function user(){

        $query = Calendar::find()->where(['id_user'=>Yii::$app->user->identity->id])->all();


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

        return $events;
    }
}
