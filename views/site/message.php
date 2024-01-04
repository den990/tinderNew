<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\UserTinder $model */

/** @var array $users */

use app\models\Photo;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\jui\DatePicker;
use yii\bootstrap5\ActiveForm;
use app\assets\MessageScreenAsset;
use app\models\UserTinder;
use consik\yii2websocket\WebSocketServer;
use Ratchet\ConnectionInterface;


MessageScreenAsset::register($this);

$this->title = 'Message';
?>

<div class="block__message">
    <div class="block__message-window">
        <div style="margin-top: 1%"></div>
        <span class="block__message-window-header-text">Сообщения</span>
        <div style="margin-top: 2%"></div>
        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="4" viewBox="0 0 100% 4" fill="none">
            <path d="M0 2H3000" stroke="#272C28" stroke-width="3"/>
        </svg>
        <div class="block__message-window-chat">
            <div class="block__message-window-chat-users">
                <?php foreach ($users as $user): ?>
                    <?php
                    $photoId = $user['photoId'];
                    $modelPhoto = Photo::find()->where(['id_photo' => $photoId])->one();
                    $photoPath = $modelPhoto->getImageUrl();
                    $photoPath = Url::to($photoPath, true);
                    $dialogId = 'dialog_' . $user['id_user'];
                    ?>
                    <div class="block__message-window-chat-user" id="<?= $dialogId ?>" data-user-id="<?= $user['id_user'] ?>">
                        <img src="<?= $photoPath ?>" class="block__message-window-chat-user-photo" width="80px"
                             height="80px">
                        <div class="block__message-window-chat-user-info">
                            <span class="block__message-window-chat-user-info-name"><?= $user['first_name'] ?> <?= $user['last_name'] ?></span>
                            <span class="block__message-window-chat-user-info-message">Сори не тебе пригожин с ...</span>
                        </div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="2" viewBox="0 0 100% 2" fill="none">
                        <path d="M0 1H3000" stroke="#272C28" stroke-width="2"/>
                    </svg>
                <?php endforeach; ?>

            </div>
            <svg id="mySvg" xmlns="http://www.w3.org/2000/svg" width="2" height="100%" viewBox="0 0 2 100%" fill="none">
                <path d="M1 0V200" stroke="#272C28" stroke-width="2"/>
            </svg>
            <div class="block__message-window__chat-message">
                <image src="images/icon_messageChat.svg" >
                <span class="block__message-window__chat-message__text">Выберите чат</span>
            </div>
            <div class="block__message-window__chat" style="display: none;">
                <div class="block__message-window__chat__user-info">
                    <span class="block__message-window__chat__user-info__name">Даниил Колдырев</span>
                    <span class="block__message-window__chat__user-info__date">Был(а) 4 часа назад</span>
                </div>
                <div class="block__message-window__chat__messages" id="chat">
                    <div class="block__message-window__chat__messages__container">
                        <image src="images/user1-photo.png" >
                            <div class="block__message-window__chat__messages-user1">
                                <span class="block__message-window__chat__messages-user1__text">Привет1</span>
                                <span class="block__message-window__chat__messages-user1__time">19:43</span>
                            </div>
                    </div>
                    <div class="block__message-window__chat__messages__container">
                        <image src="images/user2-photo.png" >
                            <div class="block__message-window__chat__messages-user2">
                                <span class="block__message-window__chat__messages-user2__text">Привет2</span>
                                <span class="block__message-window__chat__messages-user2__time">19:42</span>
                            </div>
                    </div>
                </div>
                <div class="block__message-window__chat__messaging">
                    <input type="text" id="messageInput" class="block__message-window__chat__messaging__input" placeholder="Написать сообщение...">
                    <button id="sendMessageButton" class="block__message-window__chat__messaging__button">
                        <img class="block__message-window__chat__messaging__icon" src="images/icon_send.svg" alt="Send">
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

<script>
    var csrfToken = $('meta[name=csrf-token]').attr('content');
    var chatId;
    document.addEventListener('DOMContentLoaded', function () {
        var chatContainer = document.querySelector('.block__message-window-chat-users');
        var defaultChatBlock = document.querySelector('.block__message-window__chat-message');
        var activeChatBlock = document.querySelector('.block__message-window__chat');

        chatContainer.addEventListener('click', function (event) {
            var clickedElement = event.target.closest('.block__message-window-chat-user');

            var userId = clickedElement.getAttribute('data-user-id');
            $.ajax({
                url: 'profile-other/show', // Укажите путь к вашему PHP-скрипту
                method: 'POST',
                data: {userId: userId, _csrf: csrfToken},
                success: function (response) {
                    console.log(response);

                    var userInfoName = document.querySelector('.block__message-window__chat__user-info__name');
                    //это хуйня если будем вводить когда пользователь в сети был
                    // var userInfoLastSeen = document.querySelector('.block__message-window__chat__user-info__date');

                    var userLink = document.createElement('a');
                    userLink.style.color = 'inherit';
                    userLink.style.textDecoration = 'none';

                    userLink.href = response.link;
                    userLink.innerText = response.userName;

                    var sendIcon = document.querySelector('.block__message-window__chat__messaging__icon');

                    if (response.block) {
                        sendIcon.setAttribute('src', 'images/icon_send_error.svg');
                    } else {
                        sendIcon.setAttribute('src', 'images/icon_send.svg');
                    }


                    userInfoName.innerHTML = '';
                    userInfoName.appendChild(userLink);

                },
                error: function (error) {
                    console.error(error);
                }
            });
            var chat = document.querySelector('.block__message-window__chat__messages');
            $.ajax({
                url: 'profile-other/dialog', // Укажите путь к вашему PHP-скрипту
                method: 'POST',
                data: {userId: userId, _csrf: csrfToken},
                success: function (response) {
                    chat.setAttribute('id', 'chat' + response.dialog);
                    chatId = 'chat' + response.dialog;
                    console.log(response.dialog);
                }
            });

            defaultChatBlock.style.display = 'none';
            activeChatBlock.style.display = 'block';

            // Удаляем класс active-dialog у всех диалогов
            chatContainer.querySelectorAll('.block__message-window-chat-user').forEach(function (el) {
                el.classList.remove('active');
            });

            // Добавляем класс active-dialog только кликнутому диалогу
            clickedElement.classList.add('active');
        });
    });

var selectedUserId;
document.addEventListener("DOMContentLoaded", function () {
        var chatContainer = document.querySelector('.block__message-window-chat-users');
        var defaultChatBlock = document.querySelector('.block__message-window__chat-message');
        var activeChatBlock = document.querySelector('.block__message-window__chat');

        chatContainer.addEventListener('click', function (event) {
            var clickedElement = event.target.closest('.block__message-window-chat-user');
            selectedUserId = clickedElement.getAttribute('data-user-id');  // Записываем id выбранного пользователя
            console.log('Selected User ID:', selectedUserId);
            // Ваш остальной код для обновления активного чата и т.д.
        });
    });
    
$(function() {
    var chat = new WebSocket("ws://localhost:8084");
    chat.onmessage = function(e) {
        $('#response').text('');
        var response = JSON.parse(e.data);
        if (response.type && response.type == "chat") {
            console.log(chatId);
            if(response.from == <?=Yii::$app->user->identity->getId() ?> && response.from != selectedUserId) {
                $("#" + chatId).prepend(`<div class="block__message-window__chat__messages-user1">${response.from} ${response.date} ${response.message}</div>`);
            } else {
                $("#" + chatId).prepend(`<div class="block__message-window__chat__messages-user2">${response.from} ${response.date} ${response.message}</div>`);
            }
        } else if (response.message) {
            console.log(response.message);
        }
    };

    chat.onopen = function(e) {
        console.log("Connection established!");
        chat.send(JSON.stringify({"action": "setName", "name": "<?= Yii::$app->user->identity->getId() ?>"}));
    };

    chat.onerror = function(error) {
        console.error('WebSocket Error:', error);
    };

    $("#sendMessageButton").click(function() {
        //сюда мб добавить $("#" + chatId).prepend, а сверху мб одно условие
        $.ajax({
            url: 'message/save', // Укажите путь к вашему PHP-скрипту
            method: 'POST',
            data: {message: $("#messageInput").val(), chatId: chatId, _csrf: csrfToken},
            success: function (response) {
                if (selectedUserId && $("#messageInput").val()) {
                    console.log("Sending message:", {"action" : "chat", "userId" : selectedUserId, "message" : $("#messageInput").val()});
                    chat.send( JSON.stringify({"action" : "chat", "userId" : selectedUserId, "message" : $("#messageInput").val()}) );
                    $("#messageInput").val("");
                    console.log(chat);
                } else {
                    alert(<?= Yii::t('app', '"Select a user and enter the message"') ?>);
                }
            }
        });
    });

   
});

</script>
