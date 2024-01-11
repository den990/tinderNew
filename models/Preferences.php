<?php

namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;


/**
 * Preferences model
 *
 * @property integer $id_preferences
 * @property integer $id_user
 * @property integer $location
 * @property integer $gender
 * @property integer $age_start
 * @property integer $age_end
 */

class Preferences extends ActiveRecord implements IdentityInterface
{
    public function rules()
    {
        return
        [
            ['location', 'required', 'message' => 'Выберите город'],
            ['gender', 'required'],
            ['age_start', 'required'],
            ['age_end', 'required'],
            ['age_start', 'integer', 'min' => 1, 'message' => 'Минимальный возраст должен быть больше 0'],
            ['age_end', 'integer', 'min' => 1, 'message' => 'Максимальный возраст должен быть больше 0'],
            ['age_end', 'compare', 'compareAttribute' => 'age_start', 'operator' => '>=', 'message' => 'Максимальный возраст должен быть больше или равен минимальному возрасту'],
        ];
    }

    public static function findIdentity($id)
    {
        // TODO: Implement findIdentity() method.
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    public function getId()
    {
        // TODO: Implement getId() method.
    }

    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }
}