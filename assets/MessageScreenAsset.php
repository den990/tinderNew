<?php

namespace app\assets;

use yii\web\AssetBundle;

class MessageScreenAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/message_screen.css',
    ];

    public $js = [
        'js/handler_height_window_message.js'
    ];
}