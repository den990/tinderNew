<?php

namespace app\assets;

use yii\web\AssetBundle;

class PreferencesScreenAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/preferences_screen.css',
    ];

    public $js = [
    ];
}