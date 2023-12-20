<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\Expression;

class UserListFormForMessage extends Model
{
    public $first_name;
    public $last_name;
    public $photo;

    public array $users;

    public function getUsersWithParameters($offset)
    {
        $currentUserId = Yii::$app->user->id;

        $chats = Chat::find()
            ->where(['or', ['id_user_1' => $currentUserId], ['id_user_2' => $currentUserId]])
            ->limit(Yii::$app->params['defaultLimit'])
            ->offset($offset)
            ->all();
        $result = [];
        foreach ($chats as $chat)
        {
            if ($chat['id_user_1'] != $currentUserId)
            {
                $result[] = UserTinder::findOne(['id_user' => $chat['id_user_1']]);
            }
            else
            {
                $result[] = UserTinder::findOne(['id_user' => $chat['id_user_2']]);
            }
        }
        return $result;
    }
    public function serialize()
    {
        $result = [];

        foreach($this->users as $user)
        {
            $model = new UserTinder($user);
            $result[] = $model->serializeForMessage();
        }

        return $result;
    }
}