function blockUser(userId) {
    // Отправляем AJAX-запрос на контроллер
    var csrfToken = $('meta[name=csrf-token]').attr('content');
    $.ajax({
        url: '/block/block',  // Замените это на реальный URL вашего контроллера
        method: 'POST',
        data: {userId: userId, _csrf: csrfToken},
        success: function(response) {
            console.log(response);  // Выводим ответ в консоль (можете заменить на свою логику)
            $('#blockButton')
                .text('Разблокировать')
                .attr('id', 'unblockButton')
                .data('user-id', userId)
                .removeClass('other-profile-block__additional-info__button')
                .addClass('other-profile-unblock__additional-info__button');
        },
        error: function(error) {
            console.error(error);  // Выводим ошибку в консоль (можете заменить на свою логику)
        }
    });
}

function unblockUser(userId) {
    // Отправляем AJAX-запрос на контроллер
    var csrfToken = $('meta[name=csrf-token]').attr('content');
    $.ajax({
        url: '/block/unblock',  // Замените это на реальный URL вашего контроллера
        method: 'POST',
        data: {userId: userId, _csrf: csrfToken},
        success: function(response) {
            console.log(response);  // Выводим ответ в консоль (можете заменить на свою логику)
            $('#unblockButton')
                .text('Заблокировать')
                .attr('id', 'blockButton')
                .data('user-id', userId)
                .removeClass('other-profile-unblock__additional-info__button')
                .addClass('other-profile-block__additional-info__button');
        },
        error: function(error) {
            console.error(error);  // Выводим ошибку в консоль (можете заменить на свою логику)
        }
    });
}

// JavaScript-код для обработки нажатия кнопки и вызова функции blockUser
$(document).ready(function() {
    $(document).on('click', '#blockButton', function(e) {
        e.preventDefault();
        var userId = $(this).data('user-id')
        console.log(userId);
        blockUser(userId);
    });
    $(document).on('click', '#unblockButton', function(e) {
        e.preventDefault();
        var userId = $(this).data('user-id')
        console.log(userId);
        unblockUser(userId);
    });
});