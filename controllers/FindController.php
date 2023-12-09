<?php

namespace app\controllers;

use yii\web\Controller;
use Yii;

class FindController extends Controller
{
    public $enableCsrfValidation = false;
    public function actionRedirect()
    {
        $users = Yii::$app->request->post('users');
        $users = json_decode(stripslashes($users), true);
        return $this->render('@app/views/site/find', ['users' => $users]);
    }

}