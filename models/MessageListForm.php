<?php

namespace app\models;
use yii\base\Model;

class MessageListForm extends Model
{
    public $id_chat;
    public $id_user;
    public $text;
    public $date;

    public $messages;

    public function rules()
    {
        return [
            ['id_chat', 'required'],
            ['id_user', 'required'],
            ['date', 'required'],
            ['text', 'required']
        ];
    }

    public function getMessagesWithParameters($limit, $offset, $chatId)
    {
        return Message::find()
            ->where(['id_chat' => $chatId])
            ->orderBy(['id_message' => SORT_DESC])
            ->limit($limit)
            ->offset($offset)
            ->all();
    }

    public function serialize()
    {
        $result = [];

        foreach($this->messages as $message)
        {
            $model = new Message($message);
            $result[] = $model->getShortInfo();
        }

        return $result;
    }
}