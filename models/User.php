<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

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
class User extends ActiveRecord implements IdentityInterface
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
            [['status', 'country_id'], 'integer'],
            [['name', 'city', 'address'], 'string', 'max' => 100],
            [['password_hash', 'avatar'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['color'], 'string', 'max' => 7],
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

            [['created_at'], 'date', 'format' => 'Y-m-d'],

            [['updated_at'], 'date', 'format' => 'Y-m-d'],

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

    public function status()
    {
        $this->status = '0';
    }


    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates new password reset token
     */
    /*public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }*/
    /*public function auth(){
        $session = Yii::$app->session;
        if($session->get('flag')){
            return true;
        }else{
            return false;
        }
    }*/


    /**
     * Finds an identity by the given ID.
     * @param string|integer $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|integer an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
         return $this->getPrimaryKey();
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return boolean whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
}
