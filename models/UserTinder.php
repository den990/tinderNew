<?php

namespace app\models;

use app\models\enums\Cities;
use DateTime;
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
 * @property integer $gender
 * @property string $birthday
 * @property string $email
 * @property string $password_hash
 * @property string $description
 * @property integer $location
 * @property integer $photo
 */

class UserTinder extends ActiveRecord implements IdentityInterface
{
    public $password_confirming;
    public $created_at;
    public $updated_at;

    public function rules()
    {
        return [
            ['photo', 'required', 'message' => 'Загрузите аватар'],
            [['first_name', 'last_name', 'gender', 'birthday', 'email', 'password_hash', 'location'], 'required', 'message' => 'Поле пустое'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => self::className(), 'message' => 'This email address has already been taken.'],
            ['location', 'compare', 'compareValue' => '0', 'operator' => '!=', 'message' => 'Выберите город'],

            ['password_confirming', 'compare', 'compareAttribute' => 'password_hash', 'message' => 'Пароли должны совпадать'],
        ];
    }


    public static function tableName()
    {
        return '{{%user}}';
    }

    public function getAge()
    {
        try {
            $birthDate = new \DateTime($this->birthday);
            $currentDate = new \DateTime();
            $age = $currentDate->diff($birthDate)->y;
            return $age;
        } catch (\Exception $e) {
            Yii::error('Error calculating age: ' . $e->getMessage());
            return 0; // Возвращаем 0 или другое значение по умолчанию в случае ошибки
        }
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

    public function getGender()
    {
        if ($this->gender == 0)
        {
            return 'Мужской';
        }
        else
        {
            return 'Женский';
        }
    }

    public function serializeForFind()
    {
        return [
            'first_name' => $this->first_name,
            'age' => $this->getAge(),
            'photoId' => $this->photo,
            'id_user' => $this->getId(),
            'location' => Cities::$numberToCity[$this->location],
            'gender' => $this->getGender(),
            'description' => $this->description
        ];
    }

    public function serializeForNotification($date)
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'photoId' => $this->photo,
            'id_user' => $this->getId(), // потом нужно будет для профилей
            'date' => $date,
        ];
    }

    public function serializeForMessage()
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'photoId' => $this->photo,
            'id_user' => $this->getId(),
        ];
    }
}