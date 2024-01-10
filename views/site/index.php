<?php

/** @var yii\web\View $this */


use app\assets\WelcomeScreenAsset;

WelcomeScreenAsset::register($this);

$this->title = 'Finder';
?>
<section>
    <h1 class="title">Сервис поиска новых знакомств</h1>
    <?php if (Yii::$app->user->isGuest):?>
    <a href="<?= Yii::$app->urlManager->createUrl(['site/registration']) ?>" class="register-button"><span class="register-button__text">Создать аккаунт</span></a>
    <a href="#" class="preference-button"><span class="preference-button__text">Мои предпочтения</span></a>
    <?php else: ?>
        <a href="<?= Yii::$app->urlManager->createUrl(['site/find']) ?>" class="register-button"><span class="register-button__text">Найти себе половинку</span></a>
    <?php endif; ?>

</section>
