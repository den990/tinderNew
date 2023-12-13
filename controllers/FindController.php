<?php

namespace app\controllers;

use app\models\enums\Status;
use app\models\Match;
use app\models\UserListFormForFind;
use yii\base\NotSupportedException;
use yii\helpers\Console;
use yii\web\Controller;
use Yii;

class FindController extends Controller
{
    public $users; // Переименовал свойство для единообразия
    private $count;
    private $limitCount;
    private $previousUser;
    public $enableCsrfValidation = false;
    private bool $last;

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
            $userListForm->users = $userListForm->getUsersWithParameters(1);
            $this->users = Yii::$app->session->get('userListForm', $userListForm->serialize());
            $this->limitCount = Yii::$app->session->get('limitCount', Yii::$app->params['defaultLimit']);
            $this->count = Yii::$app->session->get('count', 1);
            $this->previousUser = Yii::$app->session->get('previousUser');
            $this->last = Yii::$app->session->get('last', false);
        }

        if (!empty($this->users)) {
            $user = array_shift($this->users);
            $userId1 = Yii::$app->user->id;
            $userId2 = $this->previousUser['id_user'];

            $this->count++;
            $profileHtml = $this->renderPartial('@app/views/site/_profile', ['user' => $user]);
            $hasMoreProfiles = true;

            if ($this->count >= $this->limitCount) {
                $userListForm = new UserListFormForFind();
                $userListForm->users = $userListForm->getUsersWithParameters($this->limitCount);
                $this->users = $userListForm->serialize();
                $this->limitCount += $this->limitCount;
                $this->last = true;
            }


            $reaction = Yii::$app->request->post('reaction');
            $this->processReaction($reaction, $userId1, $userId2);

            Yii::$app->session->set('userListForm', $this->users);
            Yii::$app->session->set('limitCount', $this->limitCount);
            Yii::$app->session->set('count', $this->count);
            Yii::$app->session->set('previousUser', $user);
            Yii::$app->session->set('last', $this->last);

        }
        else
        {
            if ($this->last)
            {
                $reaction = Yii::$app->request->post('reaction');
                $userId1 = Yii::$app->user->id;
                $this->previousUser = Yii::$app->session->get('previousUser');
                $this->processReaction($reaction, $userId1, $this->previousUser['id_user']);
                Yii::$app->session->set('last', false);
            }
        }

        return json_encode(['profileHtml' => $profileHtml, 'hasMoreProfiles' => $hasMoreProfiles,]);
    }



    private function processReaction($reaction, $userId1, $userId2)
    {
        $edit = false;
        if ($userId1 >= $userId2) {
            $copyUserId1 = $userId2;
            $copyUserId2 = $userId1;
            $edit = true;
        } else {
            $copyUserId1 = $userId1;
            $copyUserId2 = $userId2;
        }


        $findMatch = Match::findOne(['id_user_1' => $copyUserId1, 'id_user_2' => $copyUserId2]);
        if ($reaction == 'like') {
            if ($findMatch == null) {
                $modelMatch = new Match();
                if ($edit)
                {
                    $modelMatch->id_user_1 = $userId2;
                    $modelMatch->id_user_2 = $userId1;
                }
                else {
                    $modelMatch->id_user_1 = $userId1;
                    $modelMatch->id_user_2 = $userId2;
                }
                $modelMatch->state = Status::IN_WAITING;
                $modelMatch->first = $userId1;
                if (!$modelMatch->save()) {
                    Yii::error("Error saving Match model: " . print_r($modelMatch->errors, true), 'app\controllers\FindController');
                }

            } else {
                if ($findMatch->first != $userId1) {
                    $findMatch->state = Status::ACCEPT;
                } else {
                    $findMatch->state = Status::IN_WAITING;
                }
                $findMatch->save();

            }
        } elseif ($reaction == 'dislike') {
            if ($findMatch == null) {
                $modelMatch = new Match();
                if ($edit)
                {
                    $modelMatch->id_user_1 = $userId2;
                    $modelMatch->id_user_2 = $userId1;
                }
                else {
                    $modelMatch->id_user_1 = $userId1;
                    $modelMatch->id_user_2 = $userId2;//короче если у нас ид 16 и доходи до 15 какого хрена записывает 16 16
                }
                $modelMatch->state = Status::CANCELED;
                $modelMatch->first = $userId1;
                $modelMatch->save();

            } else {
                $findMatch->state = Status::CANCELED;
                $findMatch->save();
            }
        }

    }
}
