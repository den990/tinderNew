<?php

namespace app\models;

use DateTime;
use Yii;
use yii\base\Model;
use yii\db\Expression;

class UserListFormForNotification extends Model
{
    public $first_name;
    public $last_name;
    public $photo;
    public $date;

    public $users;

    public function getUsersWithParameters()
    {
        $currentUserId = Yii::$app->user->id;
        $threeDaysAgo = new DateTime('-3 days');
        $formattedThreeDaysAgo = $threeDaysAgo->format('Y-m-d H:i:s');

        $userIdLikes = Like::find()
            ->where(['id_user_2' => $currentUserId])
            ->andWhere(['>=', new Expression('DATE(date)'), $formattedThreeDaysAgo]) // Условие для уведомлений за последние 3 дня
            ->orderBy(['date' => SORT_DESC]) // Сортировка по дате в убывающем порядке
            ->all();

        $result = [];
        foreach($userIdLikes as $userIdLike)
        {
            $modelUser = UserTinder::findOne(['id_user' => $userIdLike['id_user_1']]);
            $result[] = $modelUser->serializeForNotification($userIdLike['date']);
        }

        return $result;
    }
}