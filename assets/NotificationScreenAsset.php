<?php

namespace app\assets;

use yii\web\AssetBundle;

class NotificationScreenAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/notification_screen.css',
    ];

    public $js = [
        'js/handler_height_window_notification.js'
    ];
}