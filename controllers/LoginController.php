<?php

namespace app\controllers;

use app\models\enums\Cities;
use yii\base\Model;
use app\models\UserTinder;
use yii\web\Controller;
use yii\web\UploadedFile;
use Yii;

class LoginController extends Controller
{
    public function actionLogin()
    {
        $model = new UserTinder();
        if (Yii::$app->request->isPost) {
            $postData = Yii::$app->request->post();
            $model->load($postData);


                $user = UserTinder::find()->where(['email'=>$model->email])->one();
                if ($user)
                {
                    if (Yii::$app->security->validatePassword($model->password_hash, $user->password_hash))
                    {
                        var_dump("Yea");
                        Yii::$app->user->login($user);
                        return $this->goHome();
                    }
                }
                else{
                    //TODO обработать если юзера нет
                }
        }
    }
}