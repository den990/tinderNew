<?php
/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var array $user */
/** @var int $userId */


use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\jui\DatePicker;
use yii\bootstrap5\ActiveForm;
use app\assets\ProfileOtherScreenAsset;
use app\models\Photo;
use app\models\UserTinder;
use app\models\enums\Cities;
use app\models\Block;

ProfileOtherScreenAsset::register($this);

$this->title = 'Profile';
$user = UserTinder::findOne(['id_user' => $userId]);

?>

<?php if ($user): ?>
<div class="other-profile-block">
    <div class="other-profile-block__main-info-with-picture">
        <div>
            <div class="user-photo__container">
                <?php
                $photoId = $user->getPhotoId();
                $modelPhoto = Photo::find()->where(['id_photo' => $photoId])->one();
                $photoPath = $modelPhoto->getImageUrl();
                ?>
                <?= Html::img($photoPath, ['class' => 'user-photo', 'alt' => 'User Photo', 'width' => '200px', 'height' => '200px']) ?>
            </div>
        </div>
        <div class="other-profile-block__main-info">
            <div class="other-profile-block__main-info__name-birthday">
                <span class="other-profile-block__main-info__name-birthday__name"> <?= $user['first_name'] ?>  <?= $user['last_name'] ?></span>
                <span class="other-profile-block__main-info__name-birthday__birthday"><?= $user['age'] ?> лет</span>
            </div>
            <div class="other-profile-block__main-info__sex-with-icon">
                <img class="other-profile-block__main-info__sex-with-icon__icon" src="../images/icon_profile.svg" width="25">
                <span class="other-profile-block__main-info__sex">
                    <?php if ($user['gender'] == 0): ?>
                        Мужской
                    <?php else: ?>
                        Женский
                    <?php endif; ?>
                </span>
            </div>
            <div class="other-profile-block__main-info__city-with-icon">
                <img src="../images/icon_house.svg" width="35">
                <?php
                $locationId = $user['location'];
                $location = Cities::$numberToCity[$locationId];
                ?>
                <span class="other-profile-block__main-info__city"><?= $location ?></span>
            </div>
        </div>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="4" viewBox="0 0 100% 4" fill="none">
        <path d="M0 2H3000" stroke="#272C28" stroke-width="3"/>
    </svg>
    <div class="other-profile-block__additional-info">
        <p class="other-profile-block__additional-info__text"><?= $user['description'] ?></p>
        <?php
        $modelBlock = Block::findOne(['id_user_blocker' => Yii::$app->user->getId(), 'id_user_blocked' => $user['id_user']]);
        if ($modelBlock): ?>
            <?= Html::Button('Разблокировать', ['class' => 'other-profile-unblock__additional-info__button', 'id' => 'unblockButton', 'data-user-id' => $userId,]) ?>
        <?php else: ?>
            <?= Html::Button('Заблокировать', ['class' => 'other-profile-block__additional-info__button', 'id' => 'blockButton', 'data-user-id' => $userId,]) ?>
        <?php endif; ?>
    </div>
</div>
<?php else: ?>
<div class="no-user">Пользователя не существует</div>
<?php endif; ?>



