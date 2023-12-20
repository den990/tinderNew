<?php

namespace app\controllers;

use app\models\Chat;
use app\models\enums\Status;
use app\models\Like;
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
            if ($findMatch == null) {  // если нет такой записи
                $modelMatch = new Match();
                if ($edit)//это переменная чтобы у нас записывался сначала меньший айди в 1
                {
                    $modelMatch->id_user_1 = $userId2;
                    $modelMatch->id_user_2 = $userId1;
                }
                else {
                    $modelMatch->id_user_1 = $userId1;
                    $modelMatch->id_user_2 = $userId2;
                }
                $modelMatch->state_1 = Status::IN_WAITING;
                $modelMatch->state_2 = Status::UNDEFINED;
                if (!$modelMatch->save()) {
                    Yii::error("Error saving Match model: " . print_r($modelMatch->errors, true), 'app\controllers\FindController');
                }

                $likeModel = new Like();
                $likeModel->id_user_1 = $userId1;
                $likeModel->id_user_2 = $userId2;
                $likeModel->date = date('Y-m-d H:i:s', strtotime('now'));

                if (!$likeModel->save()) {
                    Yii::error("Error saving Match model: " . print_r($likeModel->errors, true), 'app\controllers\FindController');
                }

            } else {
                if ($edit)
                {
                    $findMatch->state_2 = Status::IN_WAITING;
                }
                else
                {
                    $findMatch->state_1 = Status::IN_WAITING;
                }
                if ($findMatch->state_1 == Status::IN_WAITING && $findMatch->state_2 == Status::IN_WAITING) // если друг другу нравятся
                {
                    //создаем чат
                    $findChat = Chat::findOne(['id_user_1' => $findMatch->id_user_1, 'id_user_2' => $findMatch->id_user_2]);
                    if ($findChat == null) {
                        $modelChat = new Chat();
                        $modelChat->id_user_1 = $findMatch->id_user_1; // чтобы сразу было сначало меньший айди
                        $modelChat->id_user_2 = $findMatch->id_user_2;
                        $modelChat->date = date('Y-m-d H:i:s', strtotime('now'));
                        if (!$modelChat->save()) {
                            Yii::error("Error saving Match model: " . print_r($modelChat->errors, true), 'app\controllers\FindController');
                        }
                    }

                    //лайк, нужно будет сделать обработку на существующий
                    $findLike = Like::findOne(['id_user_1' => $userId1, 'id_user_2' => $userId2]);
                    if ($findLike == null) {
                        $likeModel = new Like();
                        $likeModel->id_user_1 = $userId1;
                        $likeModel->id_user_2 = $userId2;
                        $likeModel->date = date('Y-m-d H:i:s', strtotime('now'));
                        if (!$likeModel->save()) {
                            Yii::error("Error saving Match model: " . print_r($likeModel->errors, true), 'app\controllers\FindController');
                        }
                    }
                    else // обновляем дату
                    {
                        $findLike->date = date('Y-m-d H:i:s', strtotime('now'));
                        if (!$findLike->save()) {
                            Yii::error("Error saving Match model: " . print_r($findLike->errors, true), 'app\controllers\FindController');
                        }
                    }

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
                    $modelMatch->id_user_2 = $userId2;
                }
                $modelMatch->state_1 = Status::CANCELED;
                $modelMatch->state_2 = Status::UNDEFINED;
                if (!$modelMatch->save()) {
                    Yii::error("Error saving Match model: " . print_r($modelMatch->errors, true), 'app\controllers\FindController');
                }

            } else {
                if ($edit)
                {
                    $findMatch->state_2 = Status::CANCELED;
                }
                else
                {
                    $findMatch->state_1 = Status::CANCELED;
                }
                $findMatch->save();
                if (!$findMatch->save()) {
                    Yii::error("Error saving Match model: " . print_r($findMatch->errors, true), 'app\controllers\FindController');
                }
            }
        }

    }
}
