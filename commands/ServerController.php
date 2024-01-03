<?php
namespace app\commands;

use consik\yii2websocket\WebSocketServer;
use yii\console\Controller;
use app\daemons\ChatServer;

class ServerController extends Controller
{
    public function actionStart()
    {
        $server = new ChatServer();
        $server->port = 8084; //This port must be busy by WebServer and we handle an error
        $server->start();
    }
}