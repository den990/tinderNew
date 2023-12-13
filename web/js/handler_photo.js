function cropImage(imageElement, topPercentage, bottomPercentage) {
    var canvas = document.querySelector(".photo__user");
    var ctx = canvas.getContext("2d");

    // Загружаем изображение
    var img = new Image();
    var originalPath = canvas.getAttribute('data-photo-path');
    img.src = originalPath.replace('@web/', '');

    // Используем событие load для выполнения кода после загрузки изображения
    img.onload = function() {
        // Вычисляем размеры для обрезки
        var totalHeight = img.height;
        var croppedHeight = totalHeight * (1 - topPercentage - bottomPercentage);

        // Устанавливаем размеры холста
        canvas.width = img.width;
        canvas.height = croppedHeight;

        // Рисуем обрезанное изображение на холсте
        ctx.drawImage(img, 0, totalHeight * topPercentage, img.width, croppedHeight, 0, 0, img.width, croppedHeight);
    };
}

// Вызываем cropImage после загрузки каждого изображения
document.addEventListener('DOMContentLoaded', function() {
    // Здесь вы можете выбрать все изображения, к которым вы хотите применить cropImage
    var images = document.querySelectorAll(".photo__user");

    images.forEach(function(image) {
        cropImage(image, 0.3, 0.3);
    });
});



$(document).ready(function() {
    // Функция для обновления профиля пользователя
    function updateUserProfile(reaction) {
        $.ajax({
            url: '/find/update-profile', // Путь к вашему обработчику на сервере
            type: 'POST',
            dataType: 'json',
            data: {reaction: reaction},
            success: function(data) {
                if (data && 'hasMoreProfiles' in data && 'profileHtml' in data) {
                    if (data.hasMoreProfiles) {
                        // Обновление профиля с новыми данными
                        $('#user-card').html(data.profileHtml);
                        var image = document.querySelector(".photo__user");
                        cropImage(image, 0.3, 0.3);
                    } else {
                        // Все профили просмотрены
                        $('#user-card').html('<p class="text-users-end">По вашим параметрам больше нет пользователей.</p>');
                    }
                } else {
                    console.error('Неверный формат данных от сервера:', data);
                }
            },
            error: function(error) {
                console.error('Ошибка при обновлении профиля:', error);
            }
        });
    }

    // Обработчик для кнопки лайка
    $(document).on('click', '.like-button', function() {
        updateUserProfile('like');
    });

    // Обработчик для кнопки дизлайка
    $(document).on('click', '.dislike-button', function() {
        updateUserProfile('dislike');
    });
});

