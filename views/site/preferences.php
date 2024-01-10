<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\UserTinderUpdate $model */

use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\jui\DatePicker;
use yii\bootstrap5\ActiveForm;
use app\assets\PreferencesScreenAsset;
use app\models\Photo;

PreferencesScreenAsset::register($this);

$this->title = "Preferences";
?>