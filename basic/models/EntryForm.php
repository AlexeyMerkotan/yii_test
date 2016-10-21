<?php

namespace app\models;

use yii\base\Model;

class EntryForm extends Model
{
    public $name;
    public $email;

    public function rules()
    {
        return [
            [['name', 'email'], 'required'],
            ['email', 'email'],
        ];
    }
}

/**
 * Created by PhpStorm.
 * User: dev48
 * Date: 19.10.16
 * Time: 14:05
 */