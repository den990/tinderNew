<?php

namespace app\controllers;
use app\models\enums\Cities;
use yii\base\Model;
use app\models\UserTinder;
use yii\web\Controller;
use yii\web\UploadedFile;
use Yii;
use app\models\Photo;



class RegistrationController extends Controller
{
    public function actionRegister()
    {
        $modelTinderUser = new UserTinder();

        $modelTinderUser->photo = UploadedFile::getInstance($modelTinderUser, 'photo');

        if (Yii::$app->request->isPost) {
            $postData = Yii::$app->request->post();
            $modelTinderUser->load($postData);

            if ($modelTinderUser->validate()) {
                $password = $modelTinderUser->password_hash;
                $modelTinderUser->setPassword($password);
                    $photo = $modelTinderUser->photo;
                    $path = '@app/web/photoUsers';
                    if ($modelTinderUser->location != null)
                    {
                        $modelTinderUser->location++;
                    }
                    // Сохранение фотографии пользователя
                    if ($modelTinderUser->photo) {
                        $modelPhoto = new Photo();
                        $photoFileName = 'temp';
                        $modelPhoto->path = $photoFileName;
                        if ($modelPhoto->save()) {
                            $modelTinderUser->photo = $modelPhoto->getId();
                        }
                    }

                    if ($modelTinderUser->save()) {
                        Yii::$app->session->setFlash('success', 'Регистрация успешна');
                        $modelPhoto->id_user = $modelTinderUser->getId();
                        $modelPhoto->path = $path . '/' . 'photoIdUser' . $modelTinderUser->getId() . '.' . $photo->extension;
                        $photo->saveAs(Yii::getAlias($path) . '/' . 'photoIdUser' . $modelTinderUser->getId() . '.' . $photo->extension);
                        $modelPhoto->save();
                        return $this->redirect(['site/index']);
                    } else {
                        Yii::$app->session->setFlash('error', 'Произошла ошибка при сохранении данных.');
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Произошла ошибка при сохранении данных.');
                }

        }
        $cities = array_keys(\app\models\enums\Cities::$codeToValue);
        return $this->render('@app/views/site/registration', [

            'model' => $modelTinderUser,
            'cities' => $cities,
        ]);
    }
}