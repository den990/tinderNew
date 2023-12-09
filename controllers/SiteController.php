<?php

namespace app\controllers;

use app\models\UserListFormForFind;
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
            //gender не совсем правильно отображается
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
            return $this->render('message');
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
            return $this->render('notification');
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
            $modelUserListForm->users = $modelUserListForm->getUsersWithParameters();
            return $this->render('find', ['users' => $modelUserListForm->serialize()]);
        }
    }
}
