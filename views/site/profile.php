<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\UserTinder $model */

use yii\bootstrap5\Html;
use yii\jui\DatePicker;
use yii\bootstrap5\ActiveForm;
use app\assets\ProfileScreenAsset;

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
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="profile-editing__fields">
        <div class="profile-editing__fields__text-fields">
            <div>
                <?= $form->field($model, 'first_name')->textInput(['placeholder' => 'Имя', 'class' => 'profile-editing__fields__text-fields__input-text'])->label(false) ?>
                <?= $form->field($model, 'last_name')->textInput(['placeholder' => 'Фамилия', 'class' => 'profile-editing__fields__text-fields__input-text input-text_big field-padding'])->label(false) ?>
            </div>
            <div>
                <?= $form->field($model, 'gender')->dropDownList(['' => 'Пол', 'Мужской' => 'Мужской', 'Женский' => 'Женский'], ['class' => 'profile-editing__fields__text-fields__input-select'])->label(false) ?>
                <?= $form->field($model, 'birthday')->input('date', ['class' => 'profile-editing__fields__text-fields__date field-padding'])->label(false) ?>
            </div>

            <?= $form->field($model, 'location')->dropDownList(['' => 'Город', 'Йошкар-Ола' => 'Йошкар-Ола', 'Москва' => 'Москва', 'Санкт-Петербург' => 'Санкт-Петербург', 'Челябинск' => 'Челябинск'], ['class' => 'profile-editing__fields__text-fields__input-select__city'])->label(false) ?>

            <?= $form->field($model, 'description')->textInput(['placeholder' => 'Дополнительная информация', 'class' => 'profile-editing__fields__text-fields__input-text big-text'])->label(false) ?>
        </div>
        <?= $form->field($model, 'photo')->fileInput()->label(false) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>


