<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\assets\WelcomeScreenAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

WelcomeScreenAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kodchasan:wght@600&family=Montserrat:wght@600&display=swap" rel="stylesheet">
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100 main">
<?php $this->beginBody() ?>

<header id="header" class ="header">
    <a href="<?= Yii::$app->urlManager->createUrl(['site/index']) ?>"><span class="logo">Finder</span></a>
    <?php if (Yii::$app->user->isGuest): ?>

        <a href="<?= Yii::$app->urlManager->createUrl(['site/login']) ?>" class="login-button">
            <span class="login-button__text" id="login-text">Войти</span>
        </a>
    <?php else: ?>

        <a  class="login-button">
            <span class="login-button__text" id="login-text">Вы вошли</span>
        </a>
    <?php endif; ?>


</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?= $content ?>
    </div>
</main>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
