<?php

namespace app\controllers;

use app\models\Block;
use app\models\Chat;
use app\models\Message;
use app\models\MessageListForm;
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
            'block' => $block,
        ];
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $response;
    }

    public function actionDialog()
    {
        $userId = Yii::$app->request->post('userId');
        $currentUserId = Yii::$app->user->getId();

        $chat = null;
        if ($userId > $currentUserId) {
            $chat = Chat::findOne(['id_user_1' => $currentUserId, 'id_user_2' => $userId]);
            }
        else
        {
            $chat = Chat::findOne(['id_user_1' => $userId, 'id_user_2' => $currentUserId]);
        }

        $messageList = new MessageListForm();
        $messageList->messages = $messageList->getMessagesWithParameters(15, 0, $chat->id_chat);
        $messages = $messageList->serialize();
        Yii::$app->session->set('countMessage', count($messages));
        $response = [
            'dialog' => $chat->id_chat,
            'userId' => $userId,
            'messages'=> $messages
        ];
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $response;
    }
}