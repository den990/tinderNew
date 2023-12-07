<?php

namespace app\models;

use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * Block model
 *
 * @property integer $id_block
 * @property integer $id_user_blocker
 * @property integer $id_user_blocked
 * @property string $date
 */


class Block extends ActiveRecord implements IdentityInterface
{
    public function rules()
    {
        return [
            ['id_user_blocker', 'required'],
            ['id_user_blocked', 'required'],
            ['date', 'required']
        ];
    }

    public static function tableName()
    {
        return '{{%block}}';
    }

    public static function findIdentity($id_block)
    {
        return static::findOne(['id_block' => $id_block]);
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