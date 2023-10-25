<?php

/** @var yii\web\View $this */

use app\assets\WelcomeScreenAsset;

WelcomeScreenAsset::register($this);

$this->title = 'Tinder';
?>
<section>
    <h1 class="title">Сервис поиска новых знакомств</h1>
    <a href="#" class="register-button"><span class="register-button__text">Создать аккаунт</span></a>
</section>
