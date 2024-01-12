<?php

namespace app\assets;

use yii\web\AssetBundle;

class RegistrationScreenAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/registration_screen.css',
    ];
    public $js = [
        'js/handle_updatePhoto.js',
    ];
}