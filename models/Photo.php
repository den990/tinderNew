<?php

namespace app\models;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

use yii\helpers\Url;


/**
 * Photo model
 *
* @property integer $id_photo
* @property string $path
* @property string $id_user
*/


class Photo extends ActiveRecord implements IdentityInterface
{

    public static function findIdentity($id_photo)
    {
        return static::findOne(['id_photo' => $id_photo]);
    }

    public function getImageUrl()
    {
        $url = str_replace('@app/', '@', $this->path);
        return $url;
    }

    public function getImageUrlForJs()
    {
        $url = str_replace('@app/web', '', $this->path);
        return $url;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public function getId()
    {
        return $this->getPrimaryKey();
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