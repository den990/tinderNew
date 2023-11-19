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
 * @property integer $location
 * @property integer $photo
 */

class UserTinderUpdate extends ActiveRecord implements IdentityInterface
{
    public $password_confirming;
    public $created_at;
    public $updated_at;
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'gender', 'birthday', 'location', 'description'], 'safe'],
            [['first_name', 'last_name', 'gender', 'birthday', 'location'], 'required'],
            ['description', 'string'],
            ['photo', 'file', 'extensions' => ['jpg', 'jpeg', 'png', 'gif'], 'maxSize' => 1024 * 1024 * 2, 'skipOnEmpty' => true],
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

    public function getPhotoId()
    {
        return $this->photo;
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