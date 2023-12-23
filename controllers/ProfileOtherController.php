<?php

namespace app\controllers;

use yii\web\Controller;
use Yii;

class ProfileOtherController extends Controller
{
    public function actionOther()
    {
        $userId = Yii::$app->request->get('userId');
        return $this->render('@app/views/site/profile-other', ['userId' => $userId]);
    }
}