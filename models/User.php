<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $auth_key
 * @property string $password_hash
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 * @property string $color
 * @property integer $bithday
 * @property string $phone
 * @property integer $country_id
 * @property string $city
 * @property string $zip
 * @property string $address
 * @property string $avatar
 *
 * @property Country $country
 */
class User extends \yii\db\ActiveRecord
{
    public $password;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'auth_key', 'password_hash'], 'required'],
            [['created_at', 'updated_at', 'status', 'country_id'], 'integer'],
            [['name', 'city', 'address'], 'string', 'max' => 100],
            [['password_hash', 'avatar'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['color'], 'string', 'max' => 6],
            [['phone'], 'string', 'max' => 50],
            [['zip'], 'string', 'max' => 10],
            [['email'], 'unique'],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetAttribute' => ['country_id' => 'id']],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'message' => 'This email address has already been taken.'],

            [['bithday'], 'date', 'format' => 'Y-m-d'],

            ['password','required'],
            ['password', 'string', 'min' => 6],


        ];
    }

    public function afterValidate()
    {
        if (!empty($this->bithday)) {
            $this->bithday = strtotime($this->bithday);
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
            'email' => Yii::t('app', 'Email'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'status' => Yii::t('app', 'Status'),
            'color' => Yii::t('app', 'Color'),
            'bithday' => Yii::t('app', 'Bithday'),
            'phone' => Yii::t('app', 'Phone'),
            'country_id' => Yii::t('app', 'Country ID'),
            'city' => Yii::t('app', 'City'),
            'zip' => Yii::t('app', 'Zip'),
            'address' => Yii::t('app', 'Address'),
            'avatar' => Yii::t('app', 'Avatar'),
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }





    public static function findByUsername($username)
    {
        return static::findOne(['email' => $username]);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    /*public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }*/
    public function auth(){
        $session = Yii::$app->session;
        if($session->get('flag')){
            return true;
        }else{
            return false;
        }
    }

}
