<?php

namespace app\models;

use Yii;
use yii\base\Model;

class UserListFormForFind extends Model
{
    public $first_name;
    public $age;
    public $photo;
    public int $id_user;

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
        $currentUserId = Yii::$app->user->id;
        $currentUser = UserTinder::findOne(['id_user'=> $currentUserId]);

        //тут с preferences
        $preferences = Preferences::findOne(['id_user' => $currentUserId]);

        $oppositeGender = $preferences->gender; // пока однополые стоят

        $minAge = $preferences->age_start; // можно в константу вынести
        $maxAge = $preferences->age_end;
        $city = $preferences->location;
        if ($city != 1) {
            return UserTinder::find()
                ->where(['and',
                    ['between', 'birthday', date('Y-m-d', strtotime("-{$maxAge} years")), date('Y-m-d', strtotime("-{$minAge} years"))],
                    ['gender' => $oppositeGender],
                    ['not', ['id_user' => $currentUser->id_user]],
                    ['location' => $city],
                ])->limit(Yii::$app->params['defaultLimit'])
                ->offset($offset)
                ->all();
        }
        else
        {
            return UserTinder::find()
                ->where(['and',
                    ['between', 'birthday', date('Y-m-d', strtotime("-{$maxAge} years")), date('Y-m-d', strtotime("-{$minAge} years"))],
                    ['gender' => $oppositeGender],
                    ['not', ['id_user' => $currentUser->id_user]],
                ])->limit(Yii::$app->params['defaultLimit'])
                ->offset($offset)
                ->all();
        }
    }


    public function serialize()
    {
        $result = [];

        foreach($this->users as $user)
        {
            $model = new UserTinder($user);
            $result[] = $model->serializeForFind();
        }

        return $result;
    }
}