<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\UserTinderUpdate $model */

use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\jui\DatePicker;
use yii\bootstrap5\ActiveForm;
use app\assets\ProfileScreenAsset;
use app\models\Photo;

ProfileScreenAsset::register($this);

$this->title = "Profile";
?>
<div class="profile-editing">

    <div class="profile-editing__title-bar">
        <span class="profile-editing__title-bar__text">Профиль</span>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="2" fill="none">
        <path d="M0 1H3000" stroke="#272C28" stroke-width="2"/>
    </svg>
    <?php $form = ActiveForm::begin(['action' => ['update/update'], 'options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="profile-editing__fields">
        <div class="profile-editing__fields__text-fields">
            <div class="profile-editing__fields__text-fields__name-block">
                <div>
                    <span class="profile-editing__fields__text-fields__text first-text">Имя</span>
                    <?= $form->field($model, 'first_name')->textInput(['placeholder' => 'Имя', 'class' => 'profile-editing__fields__text-fields__input-text'])->label(false) ?>
                </div>
                <div>
                    <span class="profile-editing__fields__text-fields__text second-text">Фамилия</span>
                    <?= $form->field($model, 'last_name')->textInput(['placeholder' => 'Фамилия', 'class' => 'profile-editing__fields__text-fields__input-text input-text_big field-padding'])->label(false) ?>
                </div>
            </div>
            <div class="profile-editing__fields_text-fields_additional-info">
                <div>
                    <span class="profile-editing__fields__text-fields__text first-text">Пол</span>
                    <?= $form->field($model, 'gender')->dropDownList(['0' => 'Мужской', '1' => 'Женский'], ['class' => 'profile-editing__fields__text-fields__input-select'])->label(false) ?>
                </div>
                <div>
                    <span class="profile-editing__fields__text-fields__text second-text">День рождения</span>
                    <?= $form->field($model, 'birthday')->widget(DatePicker::class, [
                        'options' => ['class' => 'profile-editing__fields__text-fields__date field-padding'],
                        'clientOptions' => [
                            'changeMonth' => true,
                            'changeYear' => true,
                            'yearRange' => '1980:2080',],
                        'language' => 'ru', // Укажите нужный язык
                        'dateFormat' => 'yyyy-MM-dd', // Формат даты
                    ])->label(false) ?>
                </div>
            </div>
            <div style="margin-top: 5px">
                <span class="profile-editing__fields__text-fields__text first-text">Город</span>
                <?= $form->field($model, 'location')->dropDownList($cities, [
                    'class' => 'profile-editing__fields__text-fields__input-select__city',
                    'options' => [
                        '1' => ['disabled' => true, 'selected' => true],
                    ],
                ])->label(false) ?>
            </div>
            <div style="margin-top: 5px">
                <span class="profile-editing__fields__text-fields__text first-text">Дополнительная информация</span>
                <?= $form->field($model, 'description')->textarea(['placeholder' => 'Дополнительная информация', 'class' => 'profile-editing__fields__text-fields__input-text big-text', 'rows' => '6'])->label(false) ?>
            </div>
        </div>
        <div class="profile-editing__fields__photo-button-block">
            <?php $photoId = $model->getPhotoId();
            $modelPhoto = Photo::find()->where(['id_photo' => $photoId])->one();
            $photoPath = $modelPhoto->getImageUrl();?>
            <?= Html::img($photoPath, ['class' => 'user-photo', 'id' => 'display-image', 'alt' => 'User Photo', 'width' => '200px', 'height' => '200px']) ?>
            <?= $form->field($model, 'photo')->fileInput(['id' => 'upload', 'onchange' => 'handleImageUpload()'])->label(false) ?>
            <div>
            <?= Html::submitButton('Сохранить', ['class' => 'profile-editing__fields__photo-button-block__submit-button']) ?>
            </div>
            <div>
                <?= Html::button('Выйти', [
                    'class' => 'profile-editing__fields__photo-button-block__exit-button',
                    'onclick' => 'exit()',
                ]) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>



