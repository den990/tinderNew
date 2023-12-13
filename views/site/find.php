<?php
/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var array $user */

use yii\bootstrap5\Html;
use yii\jui\DatePicker;
use yii\bootstrap5\ActiveForm;
use app\assets\FindScreenAsset;
use app\models\Photo;

FindScreenAsset::register($this);

$this->title = 'Find';

if (!empty($user)) {
    $photoId = $user['photoId'];
    $modelPhoto = Photo::find()->where(['id_photo' => $photoId])->one();
    $photoPath = $modelPhoto->getImageUrl();
    ?>
    <div class="card" id="user-card">
        <div class="card__block">
            <div class="photo">
                <canvas class="photo__user" id="photo-user" data-photo-path="<?= $photoPath ?>"></canvas>
            </div>
            <div class="card__block-info">
                <span class="card__block-info-text"><?= Html::encode($user['first_name']) ?>, <?= $user['age'] ?></span>
            </div>
            <div class="card__block-reaction">
                <button type="submit" class="dislike-button" style="background: none; border: none;">
                    <img src="images/dislike.png" width="85px" height="85px" style="margin-left: 10%">
                </button>
                <button type="submit" class="like-button" style="background: none; border: none;">
                    <img src="images/like.png" width="85px" height="85px" style="margin-right: 10%">
                </button>
            </div>
            <div style="margin-bottom: 5%"></div>
        </div>
    </div>
<?php } else { ?>
    <p class ="text-users-end">По вашим параметрам пользователей больше нет.</p>
<?php } ?>




