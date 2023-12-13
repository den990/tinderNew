<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class ReactionController extends Controller
{
    public function actionSaveReaction()
    {
        $reaction = Yii::$app->request->post('reaction');
    }
}