<?php

namespace app\models;

use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * Chat model
 *
 * @property integer $id_chat
 * @property integer $id_user_1
 * @property integer $id_user_2
 * @property string $date
 */

class Chat extends ActiveRecord implements IdentityInterface
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
        return '{{%chat}}';
    }

    public static function findIdentity($id_chat)
    {
        return static::findOne(['id_chat' => $id_chat]);
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