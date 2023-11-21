<?php

namespace app\models;

use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * Like model
 *
 * @property integer $id_like
 * @property integer $id_user_1
 * @property integer $id_user_2
 * @property string $date
 */

class Like extends ActiveRecord implements IdentityInterface
{
    public function rules()
    {
        return [
            ['id_user_1', 'required'],
            ['id_user_2', 'required'],
            ['date', 'required']
        ];
    }

    public static function tableName()
    {
        return '{{%like}}';
    }

    public static function findIdentity($id_like)
    {
        return static::findOne(['id_like' => $id_like]);
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