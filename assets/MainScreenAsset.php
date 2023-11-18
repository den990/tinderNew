<?php

namespace app\assets;

use yii\web\AssetBundle;

class MainScreenAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/main.css',
    ];
}