<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\UserTinder $model */

use yii\bootstrap5\Html;
use yii\jui\DatePicker;
use yii\bootstrap5\ActiveForm;
use app\assets\RegistrationScreenAsset;

RegistrationScreenAsset::register($this);

$this->title = 'Registration';


// Регистрируем скрипты на странице
$this->registerJs("
    $('#datepicker-input').datepicker({
        format: 'yyyy-mm-dd', // Формат даты
        autoclose: true, // Закрывать календарь после выбора даты
        language: 'ru', // Язык
    });
", \yii\web\View::POS_READY);

?>
<div class="register-block">
    <div class="register-form">
        <span class="register-form__title">Найдите свою вторую половинку</span>
        <?php $form = ActiveForm::begin(['action' => ['registration/register'], 'options' => ['enctype' => 'multipart/form-data']] ); ?>
        <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->getCsrfToken()) ?>

        <div class="register-form__elements__block-with-photo">
            <div class="register-form__elements__block-with-photo__info">
                <?= $form->field($model, 'first_name')->textInput(['placeholder' => 'Имя', 'class' => 'register-form__elements__input-text small-field'])->label(false) ?>
                <?= $form->field($model, 'last_name')->textInput(['placeholder' => 'Фамилия', 'class' => 'register-form__elements__input-text small-field'])->label(false) ?>
                <?= $form->field($model, 'gender')->dropDownList(['Мужской' => 'Мужской', 'Женский' => 'Женский'], ['class' => 'register-form__elements__input-select'])->label(false) ?>
            </div>
            <div class="register-form__elements__block-with-photo__photo-picker">
                <?= $form->field($model, 'photo')->fileInput()->label(false) ?>
            </div>
        </div>
        <?= $form->field($model, 'birthday')->widget(DatePicker::class, [
            'options' => ['class' => 'register-form__elements__input-date'],
            'clientOptions' => [
                'changeMonth' => true,
                'changeYear' => true,
                'yearRange' => '1980:2080',],
            'language' => 'ru', // Укажите нужный язык
            'dateFormat' => 'yyyy-MM-dd', // Формат даты
        ])->label(false) ?>
        <?= $form->field($model, 'email')->textInput(['placeholder' => 'E-mail', 'class' => 'register-form__elements__input-text'])->label(false) ?>
        <?= $form->field($model, 'password_hash')->passwordInput(['placeholder' => 'Пароль', 'class' => 'register-form__elements__input-text'])->label(false) ?>
        <?= $form->field($model, 'password_confirming')->passwordInput(['placeholder' => 'Подтверждение пароля', 'class' => 'register-form__elements__input-text big-input-text'])->label(false) ?>
        <?= $form->field($model, 'location')->dropDownList($cities, [
                'class' => 'register-form__elements__input-select big-select',
                'options' => [
                            '0' => ['disabled' => true, 'selected' => true],
                ],

        ])->label(false) ?>
        <?= Html::submitButton('Найти себе пару', ['class' => 'register-form__elements__button']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>
