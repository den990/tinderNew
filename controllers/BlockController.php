<?php

namespace app\controllers;

use Yii;
use app\models\Block;
use yii\web\Controller;

class BlockController extends Controller
{
    public function actionBlock()
    {
        $userIdBlocked = Yii::$app->request->post('userId');
        $userIdBlocker = Yii::$app->user->getId();
        $modelBlock = new Block();
        $modelBlock->id_user_blocked = $userIdBlocked;
        $modelBlock->id_user_blocker = $userIdBlocker;
        $modelBlock->date = date('Y-m-d H:i:s', strtotime('now'));
        if (!$modelBlock->save())
        {
            Yii::error("Error saving Match model: " . print_r($modelBlock->errors, true), 'app\controllers\BlockController');
        }
    }
    public function actionUnblock()
    {
        $userIdBlocked = Yii::$app->request->post('userId');
        $userIdBlocker = Yii::$app->user->getId();
        $modelBlock = Block::findOne(['id_user_blocker' => $userIdBlocker, 'id_user_blocked' => $userIdBlocked]);
        if (!$modelBlock->delete())
        {
            Yii::error("Error delete Match model: " . print_r($modelBlock->errors, true), 'app\controllers\BlockController');
        }
    }
}