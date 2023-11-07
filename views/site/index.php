<?php

/** @var yii\web\View $this */


use app\assets\WelcomeScreenAsset;

WelcomeScreenAsset::register($this);

$this->title = 'Finder';
?>
<section>
    <h1 class="title">Сервис поиска новых знакомств</h1>
    <a href="<?= Yii::$app->urlManager->createUrl(['site/registration']) ?>" class="register-button"><span class="register-button__text">Создать аккаунт</span></a>
</section>
