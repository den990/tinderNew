<?php

namespace app\controllers;

use app\models\enums\Cities;
use yii\base\Model;
use app\models\UserTinderUpdate;
use app\models\UserTinder;
use yii\base\NotSupportedException;
use yii\web\Controller;
use yii\web\UploadedFile;
use Yii;
use app\models\Photo;

class UpdateController extends Controller
{

    public function actionUpdate()
    {
        $cities = array_keys(Cities::$codeToValue);
        $existingId = Yii::$app->user->getId();
        $existingUserTinder = UserTinder::find()->where(['id_user' => $existingId])->one();
        var_dump($existingUserTinder->email . '<br>');
        $modelTinderUser = new UserTinderUpdate();
        if (Yii::$app->request->isPost) {
            $postData = Yii::$app->request->post();
            $modelTinderUser->load($postData);
            if ($modelTinderUser->validate()) {

                $excludeAttributes = ['id_user', 'email', 'password_hash'];
                $existingAttributes = $existingUserTinder->attributes;
                $modelAttributes = $modelTinderUser->attributes;

                foreach ($excludeAttributes as $excludeAttribute) {
                    unset($existingAttributes[$excludeAttribute]);
                    unset($modelAttributes[$excludeAttribute]);
                }

                $changedAttributes = array_diff_assoc($modelAttributes, $existingAttributes);
                if (!empty($changedAttributes)) {
                    if ($modelTinderUser->hasAttribute('photo') && isset($changedAttributes['photo'])) {
                        $photo = UploadedFile::getInstance($modelTinderUser, 'photo');
                        if ($photo == null) {
                            $photo = $modelTinderUser->photo;
                        } else {
                            $photoExtension = 'jpg';
                            $path = '@app/web/photoUsers';
                            $photo->saveAs(Yii::getAlias($path) . '/' . 'photoIdUser' . $existingId . '.' . $photoExtension);
                        }
                    }

                    foreach (array_keys($changedAttributes) as $key) {
                        if ($key == 'location') {
                            $existingUserTinder->$key = $modelTinderUser->$key++;
                        }
                        if ($key == 'photo') {
                            continue;
                        }
                        $existingUserTinder->$key = $modelTinderUser->$key;
                    }

                    if (!$existingUserTinder->save()) {
                        throw new NotSupportedException('User not saved');
                    }
                    return $this->render('@app/views/site/profile', [
                        'model' => $existingUserTinder,
                        'cities' => $cities,
                    ]);
                } else {
                    return $this->render('@app/views/site/profile', [
                        'model' => $existingUserTinder,
                        'cities' => $cities,
                    ]);
                }
            } else {
                throw new NotSupportedException('Incorrect data');
            }
        }
    }
}