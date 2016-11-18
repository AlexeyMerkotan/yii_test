<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%task}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $id_project
 * @property integer $id_user
 * @property string $description
 * @property integer $priority
 * @property integer $task_status
 * @property integer $start_at
 * @property integer $end_at
 *
 * @property Project $idProject
 * @property User $idUser
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%task}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'id_project', 'id_user', 'priority', 'task_status'], 'required'],
            [['id_project', 'id_user', 'priority', 'task_status'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
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
            'name' => Yii::t('app', 'Name'),
            'id_project' => Yii::t('app', 'Id Project'),
            'id_user' => Yii::t('app', 'Id User'),
            'description' => Yii::t('app', 'Description'),
            'priority' => Yii::t('app', 'Priority'),
            'task_status' => Yii::t('app', 'Task Status'),
            'start_at' => Yii::t('app', 'Start At'),
            'end_at' => Yii::t('app', 'End At'),
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
}
