<?php

namespace app\assets;

use yii\web\AssetBundle;

class WelcomeScreenAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/welcome_screen.css',
    ];
}