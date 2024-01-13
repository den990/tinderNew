<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\jui\DatePicker;
use yii\bootstrap5\ActiveForm;
use app\assets\LoginScreenAsset;

LoginScreenAsset::register($this);

$this->title = 'Login';
?>
<div class="login-block">
    <div class="login-form">
        <span class="login-form__title">С возвращением!</span>
        <?php $form = ActiveForm::begin(['action' => ['login/login'], 'options' => ['class' => 'login-form__elements']]); ?>
        <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->getCsrfToken()) ?>
        <?= $form->field($model, 'email')->textInput(['placeholder' => 'E-mail', 'class' => 'login-form__elements__input-text'])->label(false) ?>
        <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Пароль', 'class' => 'login-form__elements__input-text'])->label(false) ?>
        <?= Html::submitButton('Войти', ['class' => 'login-form__elements__button']) ?>
        <?php ActiveForm::end(); ?>

    </div>
</div>