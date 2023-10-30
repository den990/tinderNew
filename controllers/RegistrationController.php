<?php

namespace app\controllers;
use app\models\enums\Cities;
use yii\base\Model;
use app\models\UserTinder;
use yii\web\Controller;
use yii\web\UploadedFile;
use Yii;



class RegistrationController extends Controller
{
    public function actionRegister()
    {
        $model = new UserTinder();

        if (Yii::$app->request->isPost) {
            $postData = Yii::$app->request->post();
            $model->load($postData);

            if ($model->validate()) {
                // Валидация прошла успешно
                // Сохранение пользователя
                $password = $model->password_hash;
                $model->setPassword($password);
                $locationString = $model->location;
                $location = Cities::getNumericCode($locationString);
                if($location != null)
                {
                    $model->location = $location;
                }
                else
                {
                    Yii::$app->session->setFlash('error', 'Произошла ошибка при сохранении данных.');
                }
                var_dump($location);
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Регистрация успешна');
                    return $this->redirect(['site/index']);
                } else {
                    Yii::$app->session->setFlash('error', 'Произошла ошибка при сохранении данных.');
                }
            }
        }

        return $this->render('register', [
            'model' => $model,
            'cities' => Cities::listData(),
        ]);
    }
}