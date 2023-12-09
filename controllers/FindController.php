<?php

namespace app\controllers;

use app\models\UserListFormForFind;
use yii\helpers\Console;
use yii\web\Controller;
use Yii;

class FindController extends Controller
{
    public $users; // Переименовал свойство для единообразия
    private $count;
    private $limitCount;
    public $enableCsrfValidation = false;

    public function actionRedirect()
    {
        $users = Yii::$app->request->post('users');
        $users = json_decode(stripslashes($users), true);
        return $this->render('@app/views/site/find', ['users' => $users]);
    }

    public function actionUpdateProfile()
    {
        $hasMoreProfiles = false;
        $profileHtml = '';

        {
            $userListForm = new UserListFormForFind();
            $this->users = Yii::$app->session->get('userListForm', $this->users = $userListForm->getUsersWithParameters(0));
            $this->limitCount = Yii::$app->session->get('limitCount', Yii::$app->params['defaultLimit']);
            $this->count = Yii::$app->session->get('count', 0);
        }

        if (!empty($this->users)) {
            $user = array_shift($this->users);
            $this->count++;
            $profileHtml = $this->renderPartial('@app/views/site/_profile', ['user' => $user]);
            $hasMoreProfiles = true;

            if ($this->count >= $this->limitCount) {
                $userListForm = new UserListFormForFind();
                $this->users = $userListForm->getUsersWithParameters($this->limitCount);
                $this->limitCount += $this->limitCount;
            }
            Yii::$app->session->set('userListForm', $this->users);
            Yii::$app->session->set('limitCount', $this->limitCount);
            Yii::$app->session->set('count', $this->count);
        }

        // Сохраняем состояние в сессии

        return json_encode(['profileHtml' => $profileHtml, 'hasMoreProfiles' => $hasMoreProfiles,]);
    }

    public function init()
    {
        $this->count = 0;
        $this->limitCount = Yii::$app->params['defaultLimit'];
        $userListForm = new UserListFormForFind();
        $this->users = $userListForm->getUsersWithParameters(0);

        // Сохраняем начальные значения в сессии
    }
}
