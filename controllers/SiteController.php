<?php

namespace app\controllers;

use app\models\Chat;
use app\models\enums\Status;
use app\models\Like;
use app\models\Match;
use app\models\UserListFormForFind;
use app\models\UserListFormForMessage;
use app\models\UserListFormForNotification;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\enums\Cities;
use app\models\UserTinder;
use app\models\UserTinderUpdate;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
//        for ($i = 1; $i <= 10; $i++) {
//            $user = new UserTinder();
//            $user->first_name = 'User1' . $i;
//            $user->last_name = 'User1' . $i;
//            $user->gender = 0;
//            $user->birthday = '2020-12-01';
//            $user->email = 'user1' . $i . '@mail.ru';
//            $user->setPassword('qwertyui');
//            $user->location = 1;
//            $user->photo = 4;
//
//            // Сохранить пользователя в базу данных
//            $user->save();
//        }
//        for ($i = 2; $i <= 13; $i++) {
//            $user = new Like();
//            $user->id_user_1 = $i;
//            $user->id_user_2 = 1;
//            $user->date = date('Y-m-d H:i:s', strtotime('now'));
//
//            // Сохранить пользователя в базу данных
//            $user->save();
//            sleep(2);
//        }
//        $chat = new Chat();
//        $chat->id_user_1 = 1;
//        $chat->id_user_2 = 4;
//        $chat->date = date('Y-m-d H:i:s', strtotime('now'));
//        $chat->save();
//        $modelMatch = new Match();
//        $modelMatch->id_user_1 = 1;
//        $modelMatch->id_user_2 = 3;
//        $modelMatch->first = 1;
//        $modelMatch->state = Status::ACCEPT;
//        $modelMatch->save();
//        Yii::$app->session->remove('userListForm');
//        Yii::$app->session->remove('limitCount');
//        Yii::$app->session->remove('count');
//        Yii::$app->session->removeAllFlashes();
//        Yii::$app->session->removeAll();
//        Yii::$app->user->logout();
        return $this->render('index');
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionRegistration()
    {
        if (Yii::$app->user->isGuest) {
            $model = new UserTinder();
            $cities = array_keys(Cities::$codeToValue);

            return $this->render('registration', [
                'model' => $model,
                'cities' => $cities,
            ]);
        }
        else
        {
            return $this->goHome();
        }
    }
    /**
     * Login action.
     *
     * @return Response|string
     */

    public function actionLogin()
    {
        if (Yii::$app->user->isGuest) {
            $model = new UserTinder();
            return $this->render('login', ['model' => $model]);
        }
        else
        {
            return $this->goHome();
        }
    }

    public function actionProfile()
    {
        $model = new UserTinder();
        if (Yii::$app->user->isGuest)
        {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
        else
        {
            $userId = Yii::$app->user->getId();
            $model = UserTinderUpdate::find()->where(['id_user' => $userId])->one();
            $cities = array_keys(Cities::$codeToValue);
            return $this->render('profile', [
                'model' => $model,
                'cities' => $cities
            ]);
        }
    }

    public function  actionMessage()
    {
        $model = new UserTinder();
        if (Yii::$app->user->isGuest)
        {
            return $this->render('login', ['model' => $model]);
        }
        else
        {
            $modelUserListForm = new UserListFormForMessage();
            $modelUserListForm->users = $modelUserListForm->getUsersWithParameters(0);
            $modelUserListForm->users = $modelUserListForm->serialize();
            return $this->render('message', ['users' => $modelUserListForm->users]);
        }
    }

    public function actionNotification()
    {
        $model = new UserTinder();
        if (Yii::$app->user->isGuest)
        {
            return $this->render('login', ['model' => $model]);
        }
        else
        {
            $modelUserListForm = new UserListFormForNotification();
            $modelUserListForm->users = $modelUserListForm->getUsersWithParameters();
            return $this->render('notification', ['users' => $modelUserListForm->users]);
        }
    }

    public function actionFind()
    {
        $model = new UserTinder();
        if (Yii::$app->user->isGuest)
        {
            return $this->render('login', ['model' => $model]);
        }
        else
        {
            $modelUserListForm = new UserListFormForFind();
            $modelUserListForm->users = $modelUserListForm->getUsersWithParameters(0);
            $modelUserListForm->users = $modelUserListForm->serialize();
            $user = array_shift($modelUserListForm->users);
            if ($user) {

                Yii::$app->session->set('userListForm', $modelUserListForm->users);
                Yii::$app->session->set('limitCount', Yii::$app->params['defaultLimit']);
                Yii::$app->session->set('count', 1);
                Yii::$app->session->set('previousUser', $user);

                return $this->render('find', ['user' => $user]);
//            return $this->redirect(['test/print', 'user' => $modelUserListForm->users]);
            }
            else
            {
                return $this->goHome();
            }
        }
    }

    public function actionOtherProfile()
    {
        return $this->render('profile-other');
    }
}
