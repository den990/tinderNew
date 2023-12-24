<?php

namespace app\controllers;

use app\models\Block;
use app\models\UserTinder;
use yii\web\Controller;
use Yii;
use yii\web\Response;

class ProfileOtherController extends Controller
{
    public function actionOther()
    {
        $userId = Yii::$app->request->get('userId');
        return $this->render('@app/views/site/profile-other', ['userId' => $userId]);
    }

    public function actionShow()
    {
        $userId = Yii::$app->request->post('userId');
        $user = UserTinder::findOne(['id_user'=> $userId]);

        $modelBlock = Block::findOne(['id_user_blocker' => Yii::$app->user->getId(), 'id_user_blocked' => $userId]);
        $modelBlock1 = Block::findOne(['id_user_blocker' => $userId, 'id_user_blocked' => Yii::$app->user->getId()]);
        $block = null;
        if (!$modelBlock && !$modelBlock1)
        {
            $block = false;
        }
        else
        {
            $block = true;
        }

        $response = [
            'userName' => $user->first_name . ' ' . $user->last_name,
            'link' => 'profile/other?' . 'userId='. $user['id_user'],
            'block' => $block

        ];
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $response;
    }
}