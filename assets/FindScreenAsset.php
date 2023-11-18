<?php

namespace app\assets;

use yii\web\AssetBundle;

class FindScreenAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/find_screen.css',
    ];

    public $js = [
        'js/handler_photo.js'
    ];
}