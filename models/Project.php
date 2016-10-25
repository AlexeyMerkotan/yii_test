<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%project}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $start_at
 * @property integer $end_at
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%project}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],

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
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'start_at' => Yii::t('app', 'Start At'),
            'end_at' => Yii::t('app', 'End At'),
        ];
    }
}
