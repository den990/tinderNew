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

                <?php foreach ($users as $user): ?>
                    <div class="block__notification-window-main-user">
                        <?php
                        $photoId = $user['photoId'];
                        $modelPhoto = Photo::find()->where(['id_photo' => $photoId])->one();
                        $photoPath = $modelPhoto->getImageUrl();
                        $photoPath = Url::to($photoPath, true);
                        ?>
                        <img src="<?= $photoPath ?>" class="block__notification-window-main-user-img" width="100px"
                             height="100px">
                        <span class="block__notification-window-main-user-text">
                            Вы понравились пользователю
                            <a href="<?= 'profile/other?' . 'userId='. $user['id_user']?>" style="color: #0CE463;"><?= $user['first_name'] ?> <?= $user['last_name'] ?></a>
                            <?=$user['date'] ?>
                        </span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="2" viewBox="0 0 100% 2" fill="none">
                        <path d="M0 1H3000" stroke="#272C28" stroke-width="2"/>
                    </svg>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
</div>
