<?php
/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var array $user */


use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\jui\DatePicker;
use yii\bootstrap5\ActiveForm;
use app\assets\ProfileOtherScreenAsset;
use app\models\Photo;

ProfileOtherScreenAsset::register($this);

$this->title = 'Profile';

?>
<div class="other-profile-block">
    <div class="other-profile-block__main-info-with-picture">
        <div class="other-profile-block__main-info">
            <div class="other-profile-block__main-info__name-birthday">
                <span class="other-profile-block__main-info__name-birthday__name">Артём Иванов</span>
                <span class="other-profile-block__main-info__name-birthday__birthday">20 лет</span>
            </div>
            <div class="other-profile-block__main-info__sex-with-icon">
                <img src="../images/icon_profile.svg" width="25">
                <span class="other-profile-block__main-info__sex">Пол</span>
            </div>
            <div class="other-profile-block__main-info__city-with-icon">
                <img src="../images/icon_house.svg" width="35">
                <span class="other-profile-block__main-info__city">Йошкар-Ола</span>
            </div>
        </div>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="4" viewBox="0 0 100% 4" fill="none">
        <path d="M0 2H3000" stroke="#272C28" stroke-width="3"/>
    </svg>
    <div class="other-profile-block__additional-info">
        <p class="other-profile-block__additional-info__text">АУЕ, ЖИЗНЬ ВОРАМ</p>
        <?= Html::submitButton('Заблокировать', ['class' => 'other-profile-block__additional-info__button']) ?>
    </div>
</div>