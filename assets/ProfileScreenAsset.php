<?php

namespace app\assets;

use yii\web\AssetBundle;

class ProfileScreenAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/profile_screen.css',
    ];

    public $js = [
        'js/handle_updatePhoto.js',
    ];
}