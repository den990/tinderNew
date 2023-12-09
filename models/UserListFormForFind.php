<?php

namespace app\models;

use Yii;
use yii\base\Model;

class UserListFormForFind extends Model
{
    public $first_name;
    public $age;
    public $photo;

    public $users;

    public function rules()
    {
        return [
            ['first_name', 'required'],
            ['age', 'required'],
            ['photo', 'required']
        ];
    }

    public function getUsersWithParameters($offset)
    {
        $currentUserId = Yii::$app->user->getId();
        $currentUser = UserTinder::findOne(['id_user'=> $currentUserId]);

        $oppositeGender = ($currentUser->gender != 0) ? 1 : 0; // пока однополые стоят

        $minAge = $currentUser->getAge() - 5; // можно в константу вынести
        $maxAge = $currentUser->getAge() + 5;

        return UserTinder::find()
            ->where(['and',
                ['between', 'birthday', date('Y-m-d', strtotime("-{$maxAge} years")), date('Y-m-d', strtotime("-{$minAge} years"))],
                ['gender' => $oppositeGender],
                ['not', ['id_user' => $currentUser->id_user]],
            ])->limit(Yii::$app->params['defaultLimit'])
            ->offset($offset)
            ->all();
    }

    public function serialize()
    {
        $result = [];

        foreach($this->users as $user)
        {
            $model = new UserTinder($user);
            $result[] = $model->serializeForFind();//TODO пока хуй знает будет работать или нет
        }

        return $result;
    }
}