<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_project".
 *
 * @property integer $id
 * @property integer $id_user
 * @property integer $id_project
 *
 * @property Project $idProject
 * @property User $idUser
 */
class UserProject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_project}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'id_project'], 'integer'],
            [['id_project'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['id_project' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
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
        ];
    }
    public  function get_AddUser_Project($project,$id_user){
        $this->id_user=$id_user;
        $this->id_project=$project;
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
