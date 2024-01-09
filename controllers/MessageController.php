<?php

namespace app\controllers;

use app\models\Message;
use app\models\MessageListForm;
use app\models\Photo;
use app\models\UserTinder;
use yii\web\Controller;
use Yii;
use yii\web\Response;

class MessageController extends Controller
{
    public function actionSave()
    {
        $message = Yii::$app->request->post('message');
        $chatId = Yii::$app->request->post('chatId');
        $modelMeesage = new Message();
        $modelMeesage->id_chat = str_replace('chat', '', $chatId);
        $modelMeesage->id_user = Yii::$app->user->getId();
        $modelMeesage->text = $message;
        $modelMeesage->date = date('Y-m-d H:i:s', strtotime('now'));
        $modelMeesage->isRead = false;
        if (!$modelMeesage->save()) {
            Yii::error("Error saving Message model: " . print_r($modelMeesage->errors, true), 'app\controllers\MessageController');
        }

    }

    public function actionGetPhotoUser()
    {
        $userId = Yii::$app->request->post('userId');
        $modelPhoto = Photo::findOne(['id_user' => $userId]);

        $response = [
            'path' => $modelPhoto->getImageUrlForJs()
        ];
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $response;
    }

    public function actionGetMessage()
    {
        $chatId = Yii::$app->request->post('chatId');
        $chatIdNumber = (int)str_replace('chat', '', $chatId);
        $messageListForm = new MessageListForm();
        $offset = Yii::$app->session->get('countMessage');
        if ($offset >= Yii::$app->session->get('defaultLimitMessages'))
        {
            $newLimit = Yii::$app->session->get('defaultLimitMessages') + Yii::$app->params['defaultLimitMessages'];
            Yii::$app->session->set('defaultLimitMessages', $newLimit);
        }
        $messageListForm->messages = $messageListForm->getMessagesWithParameters(Yii::$app->params['defaultLimitMessages'], $offset, $chatIdNumber);
        $messageListForm->messages = $messageListForm->serialize();
        Yii::$app->session->set('countMessage', $offset + Yii::$app->params['defaultLimitMessages']);
        //кежшировать с помощью set и забирать с get, при клике на новый чат set'ом обнуляем все, миграция для изменения жаты с временем
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $messageListForm->messages;
    }
}