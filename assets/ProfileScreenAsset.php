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
}