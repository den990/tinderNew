<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\Preferences $model */

use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\jui\DatePicker;
use yii\bootstrap5\ActiveForm;
use app\assets\PreferencesScreenAsset;
use app\models\Photo;

PreferencesScreenAsset::register($this);

$this->title = "Preferences";
?>
<div class="preferences-block">
    <div class="preferences-block__title">
        <span class="preferences-block__title__text">Кого я ищу?</span>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="3" fill="none">
        <path d="M0 1H3000" stroke="#3F3F3F" stroke-width="3"/>
    </svg>
    <?php $form = ActiveForm::begin(['action' => ['preferences/update'], 'options' => ['enctype' => 'multipart/form-data']] ); ?>
    <div class="preferences-block__main">
        <div class="preferences-block__main__sex-age">
            <div class="preferences-block__main__sex-age__labels">
                <span class="preferences-block__main__sex-age__labels__text preferences-block__main__sex-age__labels__text_sex">Пол</span>
                <span class="preferences-block__main__sex-age__labels__text preferences-block__main__sex-age__labels__text_age">Возраст</span>
            </div>
            <div class="preferences-block__main__sex-age__inputs">
                <?= $form->field($model, 'gender')->dropDownList(['0' => 'Мужской', '1' => 'Женский'], ['class' => 'input-style preferences-block__main__sex-age__inputs__sex'])->label(false) ?>
                <?= $form->field($model, 'age_start')->textInput(['placeholder' => 'От', 'class' => 'input-style preferences-block__main__sex-age__inputs__age-min'])->label(false) ?>
                <?= $form->field($model, 'age_end')->textInput(['placeholder' => 'До', 'class' => 'input-style preferences-block__main__sex-age__inputs__age-max'])->label(false) ?>
            </div>
        </div>
        <div class="preferences-block__main__city">
            <span class="preferences-block__main__city__text">Город</span>
            <?= $form->field($model, 'location')->dropDownList($cities, [
                'class' => 'input-style preferences-block__main__city__input',
            ])->label(false) ?>
        </div>
        <?= Html::submitButton('Сохранить', ['class' => 'preferences-block__main__button']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
