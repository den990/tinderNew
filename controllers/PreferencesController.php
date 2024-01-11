<?php

namespace app\controllers;

use app\models\enums\Cities;
use app\models\Preferences;
use yii\web\Controller;
use Yii;

class PreferencesController extends Controller
{
    public function actionUpdate()
    {
        if (Yii::$app->request->isPost)
        {
            $cities = array_merge(['1'], array_keys(Cities::$codeToValue));
            unset($cities['0']);
            $cities[1] = 'Все города';

            $modelPreferencesExist = Preferences::findOne(['id_user' => Yii::$app->user->getId()]);
            $modelPreferences = new Preferences();
            $postData = Yii::$app->request->post();
            $modelPreferences->load($postData);
            if ($modelPreferences->validate())
            {
                $excludeAttributes = ['id_user', 'id_preferences'];

                $existingAttributes = $modelPreferencesExist->attributes;
                $modelAttributes = $modelPreferences->attributes;

                foreach ($excludeAttributes as $excludeAttribute) {
                    unset($existingAttributes[$excludeAttribute]);
                    unset($modelAttributes[$excludeAttribute]);
                }

                $changedAttributes = array_diff_assoc($modelAttributes, $existingAttributes);
                if (!empty($changedAttributes))
                {
                    $modelPreferences->id_user = Yii::$app->user->getId();

                    foreach (array_keys($changedAttributes) as $key) {
                        $modelPreferencesExist->$key = $modelPreferences->$key;
                    }

                    if (!$modelPreferencesExist->save()) {
                        Yii::error("Error saving Preferences model: " . print_r($modelPreferencesExist->errors, true), 'app\controllers\PreferencesController');
                    }

                    return $this->render('@app/views/site/preferences', [
                        'model' => $modelPreferencesExist,
                        'cities' => $cities,
                    ]);
                }
                else
                {
                    return $this->render('@app/views/site/preferences', [
                        'model' => $modelPreferencesExist,
                        'cities' => $cities,
                    ]);
                }
            }
            else
            {
                var_dump($modelPreferences);
            }
        }
        else
        {
            var_dump('kek');
        }
    }
}