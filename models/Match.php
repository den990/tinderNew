<?php

namespace app\models;

use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * Match model
 *
 * @property integer $id_match
 * @property integer $id_user_1
 * @property integer $id_user_2
 * @property integer $status
 */

class Match extends ActiveRecord implements IdentityInterface
{

    public function rules()
    {
        return [
            ['id_user_1', 'required'],
            ['id_user_2', 'required'],
            ['status', 'required']
        ];
    }

    public static function tableName()
    {
        return '{{%match}}';
    }

    public static function findIdentity($id_match)
    {
        return static::findOne(['id_match' => $id_match]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public function getId()
    {
        return $this->primaryKey();
    }

    public function getAuthKey()
    {
        throw new NotSupportedException('"getAuthKey" is not implemented.');
    }

    public function validateAuthKey($authKey)
    {
        throw new NotSupportedException('"validateAuthKey" is not implemented.');
    }
}