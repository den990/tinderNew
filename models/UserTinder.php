<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;


/**
 * UserTinder model
 *
 * @property integer $id_user
 * @property string $first_name
 * @property string $last_name
 * @property string $gender
 * @property string $birthday
 * @property string $email
 * @property string $password_hash
 * @property string $description
 * @property string $location
 * @property string $photo
 */

class UserTinder extends ActiveRecord implements IdentityInterface
{
    public $password_confirming;
    public $created_at;
    public $updated_at;
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'gender', 'birthday', 'email', 'password_hash', 'location'], 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => self::className(), 'message' => 'This email address has already been taken.'],
        ];
    }

    public static function tableName()
    {
        return '{{%user}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public static function findIdentity($id_user)
    {
        return static::findOne(['id_user' => $id_user]);
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }


    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
}