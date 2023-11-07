<?php

namespace app\assets;

use yii\web\AssetBundle;

class LoginScreenAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/login_screen.css',
    ];
}