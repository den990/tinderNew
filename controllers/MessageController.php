<?php

namespace app\controllers;

use app\models\Message;
use yii\web\Controller;
use Yii;

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
}