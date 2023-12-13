<?php

namespace app\models\enums;

use yii2mod\enum\helpers\BaseEnum;

class Status extends BaseEnum
{
    public static $messageCategory = 'app';
    const ACCEPT = 1;
    const CANCELED = 2;
    const IN_WAITING = 3;
    public static $state = [
        'Accept' => 0,
        'Canceled' => 1,
        'In Waitind' => 2,
    ];
}