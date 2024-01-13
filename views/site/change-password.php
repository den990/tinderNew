<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var ChangePasswordForm $model */


use yii\bootstrap5\Html;
use yii\jui\DatePicker;
use yii\bootstrap5\ActiveForm;
use app\assets\ChangePasswordScreenAsset;
use app\models\ChangePasswordForm;

ChangePasswordScreenAsset::register($this);

if ($model == null) {
    $model = new ChangePasswordForm();
}

$this->title = 'Change Password';
?>

<div class="change-password-block">
    <div class="change-password-block__title">
        <span class="change-password-block__title__text">Смена пароля</span>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="3" fill="none">
        <path d="M0 1H3000" stroke="#3F3F3F" stroke-width="3"/>
    </svg>
    <?php $form = ActiveForm::begin(['action' => ['update/change-password'], 'fieldConfig' => [
        'errorOptions' => ['class' => 'invalid-feedback', 'encode' => false],
    ],]); ?>
    <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->getCsrfToken()) ?>
    <div class="change-password-block__main">
        <div class="change-password-block__main__old-password">
            <span class="change-password-block__main__old-password__text">Старый пароль</span>
            <?= $form->field($model, 'old_password')->passwordInput(['placeholder' => '', 'class' => 'change-password-block__main__old-password__input'])->label(false) ?>
        </div>
        <div class="change-password-block__main__new-password">
            <span class="change-password-block__main__new-password__text">Новый пароль</span>
            <?= $form->field($model, 'new_password')->passwordInput(['placeholder' => '', 'class' => 'change-password-block__main__new-password__input'])->label(false) ?>
        </div>
        <div class="change-password-block__main__new-password-repeat">
            <span class="change-password-block__main__new-password-repeat__text">Подтверждение нового пароля</span>
            <?= $form->field($model, 'password_confirming')->passwordInput(['placeholder' => '', 'class' => 'change-password-block__main__new-password-repeat__input'])->label(false) ?>
        </div>
        <div class="change-password-block__main__button-container">
            <?= Html::submitButton('Сохранить', ['class' => 'change-password-block__main__button-container__button']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
