<?php

namespace app\controllers;
use app\models\enums\Cities;
use yii\base\Model;
use app\models\UserTinder;
use yii\base\NotSupportedException;
use yii\web\Controller;
use yii\web\UploadedFile;
use Yii;
use app\models\Photo;



class RegistrationController extends Controller
{
    public function actionRegister()
    {
        $modelTinderUser = new UserTinder();

        if (Yii::$app->request->isPost) {
            $postData = Yii::$app->request->post();
            $modelTinderUser->load($postData);
            $modelTinderUser->photo = UploadedFile::getInstance($modelTinderUser, 'photo');
            if ($modelTinderUser->validate()) {
                $password = $modelTinderUser->password_hash;
                $modelTinderUser->setPassword($password);
                $modelTinderUser->password_confirming = $modelTinderUser->password_hash;
                    $photo = $modelTinderUser->photo;
                    $path = '@app/web/photoUsers';

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
                        $photoExtension = 'jpg';
                        $photo->saveAs(Yii::getAlias($path) . '/' . 'photoIdUser' . $modelTinderUser->getId() . '.' . $photoExtension);
                        $modelPhoto->save();
                        return $this->redirect(['site/index']);
                    } else {

                            Yii::error("Error saving Match model: " . print_r($modelTinderUser->errors, true), 'app\controllers\RegistrationController');
                        Yii::$app->session->setFlash('error', 'Произошла ошибка при сохранении данных.');
                        $cities = array_keys(Cities::$codeToValue);
                        $modelTinderUser->password_hash =$password;
                        $modelTinderUser->password_confirming = $password;
                        return $this->render('@app/views/site/registration', [

                            'model' => $modelTinderUser,
                            'cities' => $cities,
                        ]);
                    }
                } else {
                throw new NotSupportedException('Not validation');
                }
        }

    }
}