<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\enums\Cities;
use app\models\UserTinder;

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
        $model = new UserTinder();
        $cities = array_keys(Cities::$codeToValue);

        return $this->render('registration', [
            'model' => $model,
            'cities' => $cities,
        ]);
    }
    /**
     * Login action.
     *
     * @return Response|string
     */

    public function actionLogin()
    {
        $model = new UserTinder();
        return $this->render('login',[ 'model' => $model]);
    }

    public function actionProfile()
    {
        $model = new UserTinder();
        if (Yii::$app->user->isGuest)
        {
            return $this->render('login', ['model' => $model]);
        }
        else
        {
            $cities = array_keys(Cities::$codeToValue);
            //нужно получить user чтобы по дфеолту в input стояли значения юзера
            return $this->render('profile', ['model' => $model]);
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
            return $this->render('find');
        }
    }
}
