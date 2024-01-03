<?php

namespace app\daemons;

use consik\yii2websocket\events\WSClientEvent;
use consik\yii2websocket\WebSocketServer;
use Ratchet\ConnectionInterface;
use Yii;
class ChatServer extends WebSocketServer
{

    public function init()
    {
        parent::init();

        $this->on(self::EVENT_CLIENT_CONNECTED, function (WSClientEvent $e) {
            $e->client->name = null;
        });
    }


    protected function getCommand(ConnectionInterface $from, $msg)
    {
        $request = json_decode($msg, true);
        return !empty($request['action']) ? $request['action'] : parent::getCommand($from, $msg);
    }

    public function commandChat(ConnectionInterface $client, $msg)
    {
        $request = json_decode($msg, true);
        $result = ['message' => 'Chat Ok'];
        $user = $request['userId'];
        if (!$client->name) {
            $result['message'] = Yii::t('app', 'You need to be logged for chatting');
        } elseif (!empty($request['message']) && $message = trim($request['message']) ) {
            foreach ($this->clients as $chatClient) {
                if ($chatClient->name == $user || $chatClient == $client) {
                    $chatClient->send(json_encode([
                        'type' => 'chat',
                        'from' => $client->name,
                        'date' => date('Y-m-d H:i:s'),
                        'message' => $message
                    ]));
                }
            }
        } else {
            $result['message'] =Yii::t('app', 'Enter a message');
        }
        $client->send( json_encode($result) );
//        if (!empty($request['userId']) && ($userId = trim($request['userId'])) && ($message = trim($request['message']))) {
//            // Проверяем, что выбранный пользователь существует и он онлайн
//            if (isset($this->clients[$userId])) {
//                // Отправляем сообщение только выбранному пользователю
//                $this->clients[$userId]->send(json_encode(
//                    [
//                        'type' => 'chat',
//                        'from' => $client->name, // заменили userId на name
//                        'message' => $message
//                    ]
//                ));
//            } else {
//                $result['message'] = 'User not found or offline';
//            }
//        } else {
//            $result['message'] = 'Enter message';
//        }
//
//        $client->send(json_encode($result));
    }


    public function commandSetName(ConnectionInterface $client, $msg)
    {
        $request = json_decode($msg, true);
        $result = ['message' => 'User updated'];

        if (!empty($request['name']) && $name = trim($request['name'])) {
            $usernameFree = true;
            foreach ($this->clients as $chatClient) {
                if ($chatClient != $client && $chatClient->name == $name) {
                    $result['message'] = 'This name is used by other user';
                    $usernameFree = false;
                    break;
                }
            }

            if ($usernameFree) {
                $client->name = $name;
            }
        } else {
            $result['message'] = 'Invalid username';
        }

        $client->send(json_encode($result));
    }

}