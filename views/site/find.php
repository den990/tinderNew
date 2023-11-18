<?php
/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\UserTinder $model */

use yii\bootstrap5\Html;
use yii\jui\DatePicker;
use yii\bootstrap5\ActiveForm;
use app\assets\FindScreenAsset;

FindScreenAsset::register($this);

$this->title = 'Find';

?>

<div class="card">
    <div class="card__block">
        <div class="photo">
            <canvas class="photo__user" id="photo-user"></canvas>
        </div>
        <div class="card__block-info">
            <span class="card__block-info-text">Даниил, 20</span>
        </div>
        <div class="card__block-reaction">
            <img src="images/dislike.png" width="85px" height="=85px" style="margin-left: 10%">
            <img src="images/like.png" width="85px" height="=85px" style="margin-right: 10%">
        </div>
        <div style="margin-bottom: 5%"></div>
    </div>
</div>
