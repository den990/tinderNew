<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\UserTinder $model */

/** @var array $users */

use app\models\Photo;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\jui\DatePicker;
use yii\bootstrap5\ActiveForm;
use app\assets\MessageScreenAsset;

MessageScreenAsset::register($this);

$this->title = 'Message';
?>

<div class="block__message">
    <div class="block__message-window">
        <div style="margin-top: 1%"></div>
        <span class="block__message-window-header-text">Сообщения</span>
        <div style="margin-top: 2%"></div>
        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="4" viewBox="0 0 100% 4" fill="none">
            <path d="M0 2H3000" stroke="#272C28" stroke-width="3"/>
        </svg>
        <div class="block__message-window-chat">
            <div class="block__message-window-chat-users">
                <?php foreach ($users as $user): ?>
                    <?php
                    $photoId = $user['photoId'];
                    $modelPhoto = Photo::find()->where(['id_photo' => $photoId])->one();
                    $photoPath = $modelPhoto->getImageUrl();
                    $photoPath = Url::to($photoPath, true);
                    ?>
                    <div class="block__message-window-chat-user">
                        <img src="<?= $photoPath ?>" class="block__message-window-chat-user-photo" width="80px"
                             height="80px">
                        <div class="block__message-window-chat-user-info">
                            <span class="block__message-window-chat-user-info-name"><?= $user['first_name'] ?> <?= $user['last_name'] ?></span>
                            <span class="block__message-window-chat-user-info-message">Сори не тебе пригожин с ...</span>
                        </div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="2" viewBox="0 0 100% 2" fill="none">
                        <path d="M0 1H3000" stroke="#272C28" stroke-width="2"/>
                    </svg>
                <?php endforeach; ?>

            </div>
            <svg id="mySvg" xmlns="http://www.w3.org/2000/svg" width="2" height="100%" viewBox="0 0 2 100%" fill="none">
                <path d="M1 0V200" stroke="#272C28" stroke-width="2"/>
            </svg>
            <div></div>
        </div>
    </div>
</div>
