<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\UserTinder $model */

use yii\bootstrap5\Html;
use yii\jui\DatePicker;
use yii\bootstrap5\ActiveForm;
use app\assets\ChangePasswordScreenAsset;

ChangePasswordScreenAsset::register($this);

$this->title = 'Change Password';
?>

<div class="change-password-block">
    <div class="change-password-block__title">
        <span class="change-password-block__title__text">Смена пароля</span>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="3" fill="none">
        <path d="M0 1H3000" stroke="#3F3F3F" stroke-width="3"/>
    </svg>
    <div class="change-password-block__main">
        <div class="change-password-block__main__old-password">
            <span class="change-password-block__main__old-password__text">Старый пароль</span>
            <input type="text" class="change-password-block__main__old-password__input">
        </div>
        <div class="change-password-block__main__new-password">
            <span class="change-password-block__main__new-password__text">Новый пароль</span>
            <input type="text" class="change-password-block__main__new-password__input">
        </div>
        <div class="change-password-block__main__new-password-repeat">
            <span class="change-password-block__main__new-password-repeat__text">Подтверждение нового пароля</span>
            <input type="text" class="change-password-block__main__new-password-repeat__input">
        </div>
        <div class="change-password-block__main__button-container">
            <button class="change-password-block__main__button-container__button">Сохранить</button>
        </div>
    </div>
</div>
