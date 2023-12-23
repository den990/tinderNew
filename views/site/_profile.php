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


    $photoId = $user['photoId'];
    $modelPhoto = Photo::find()->where(['id_photo' => $photoId])->one();
    $photoPath = $modelPhoto->getImageUrl();

    ?>

    <?php if (!empty($user)): ?>
        <div class="card__block">
            <div class="photo">
                <canvas class="photo__user" id="photo-user" data-photo-path="<?= $photoPath ?>"></canvas>
            </div>
            <div class="card__block-info">
                <div>
                    <span class="card__block-info__name-text"><?= Html::encode($user['first_name']) ?></span>
                    <span class="card__block-info__age-text">, Возраст</span>
                </div>
                <div class="card__block-info__add-info__city">
                    <img src="../images/icon_house.svg" width="35">
                    <span class="card__block-info__city__text">Живёт в: Город</span>
                </div>
                <div class="card__block-info__add-info__sex">
                    <img src="../images/icon_profile.svg" width="25">
                    <span class="card__block-info__sex__text">Пол</span>
                </div>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="4" viewBox="0 0 100% 4" fill="none">
                <path d="M0 2H3000" stroke="#272C28" stroke-width="3"/>
            </svg>
            <div class="card__block__additional-info">
                <span class="card__block__additional-info__text">Бродяга</span>
            </div>
            <div class="card__block-reaction">
                <button type="submit" class="dislike-button" style="background: none; border: none;">
                    <img src="images/dislike.png" width="45px" height="45px" style="margin-left: 10%">
                </button>
                <button type="submit" class="like-button" style="background: none; border: none;">
                    <img src="images/like.png" width="45px" height="45px" style="margin-right: 10%">
                </button>
            </div>
            <div style="margin-bottom: 5%"></div>
        </div>
    <?php endif; ?>
