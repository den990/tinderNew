<?php
/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\UserTinder $model */

use yii\bootstrap5\Html;
use yii\jui\DatePicker;
use yii\bootstrap5\ActiveForm;
use app\assets\NotificationScreenAsset;

NotificationScreenAsset::register($this);

$this->title = 'Notification';

?>
<div class="block__notification">
    <div class="block__notification-window">
        <div style="margin-top: 1%"></div>
        <span class="block__notification-window-header-text">Уведомления</span>
        <div style="margin-top: 2%"></div>
        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="4" viewBox="0 0 100% 4" fill="none">
            <path d="M0 2H3000" stroke="#272C28" stroke-width="3"/>
        </svg>
        <div class="block__notification-window-main">
            <div class="block__notification-window-main-users">
                <div class="block__notification-window-main-user">
                    <img src="images/priora.jpg" class="block__notification-window-main-user-img" width="100px"
                         height="100px">
                    <span class="block__notification-window-main-user-text">Вы понравились пользователю <a href="#"
                                                                                                           style="color: #0CE463;">Артём Иванов</a></span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="2" viewBox="0 0 100% 2" fill="none">
                    <path d="M0 1H3000" stroke="#272C28" stroke-width="2"/>
                </svg>
                <div class="block__notification-window-main-user">
                    <img src="images/priora.jpg" class="block__notification-window-main-user-img" width="100px"
                         height="100px">
                    <span class="block__notification-window-main-user-text">Вы понравились пользователю <a href="#"
                                                                                                           style="color: #0CE463;">Артём Иванов</a></span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="2" viewBox="0 0 100% 2" fill="none">
                    <path d="M0 1H3000" stroke="#272C28" stroke-width="2"/>
                </svg>
            </div>
        </div>
    </div>
</div>
