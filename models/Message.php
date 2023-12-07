<?php

namespace app\models;

use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;


/**
 * Message model
 *
 * @property integer $id_message
 * @property integer $id_chat
 * @property integer $id_user
 * @property string $text
 * @property string $date
 * @property boolean $isRead
 */

class Message extends ActiveRecord implements IdentityInterface
{
    public function rules()
    {
        return [
            ['id_message', 'required'],
            ['id_chat', 'required'],
            ['id_user', 'required'],
            ['text', 'required'],
            ['date', 'required'],
        ];
    }

    public static function tableName()
    {
        return '{{%chat}}';
    }

    public static function findIdentity($id_message)
    {
        return static::findOne(['id_message' => $id_message]);
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