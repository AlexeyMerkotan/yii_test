<?php

namespace app\models;

use Yii;

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


            [['start_at','end_at'], 'date', 'format' => 'Y-m-d'],

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
            'id_user' => Yii::t('app', 'Id User'),
            'id_project' => Yii::t('app', 'Id Project'),
            'start_at' => Yii::t('app', 'Start At'),
            'end_at' => Yii::t('app', 'End At'),
            'comment' => Yii::t('app', 'Comment'),
        ];
    }
    public function get_UpdateCalendar(){
        $calendar=Calendar::findOne($_POST['id']);
        $this->id_user=$_POST['id_user'];
        $this->id_project=$_POST['id_project'];
        $this->start_at=$_POST['start_at'];
        $this->end_at=$_POST['end_at'];
        $this->comment=$_POST['comment'];
        $this->save();
    }

    public function get_AddCalendar(){
        $this->id_user=$_POST['id_user'];
        $this->id_project=$_POST['id_project'];
        $this->start_at=$_POST['start_at'];
        $this->end_at=$_POST['end_at'];
        $this->comment=$_POST['comment'];
        $this->save();
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
}
