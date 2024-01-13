<?php

namespace app\controllers;

use app\models\enums\Cities;
use app\models\LoginForm;
use yii\base\Model;
use app\models\UserTinder;
use yii\web\Controller;
use yii\web\UploadedFile;
use Yii;

class LoginController extends Controller
{
    public function actionLogin()
    {
        $model = new LoginForm();
        if (Yii::$app->request->isPost) {
            $postData = Yii::$app->request->post();
            $model->load($postData);

                $user = UserTinder::find()->where(['email'=>$model->email])->one();

                    if ($model->validate())
                    {
                        Yii::$app->user->login($user);
                        return $this->goHome();
                    }
                    else
                    {
                        return $this->render('@app/views/site/login', ['model' => $model]);
                    }
        }
        return $this->render('@app/views/site/login', [
            'model' => $model,
        ]);
    }
}