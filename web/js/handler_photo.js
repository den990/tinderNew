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
