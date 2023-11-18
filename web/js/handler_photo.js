function cropImage(imageElement, topPercentage, bottomPercentage) {
    var canvas = document.querySelector(".photo__user");
    var ctx = canvas.getContext("2d");

    // Загружаем изображение
    var img = new Image();
    img.src = "images/priora1.jpg";
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

// Дожидаемся загрузки страницы и вызываем cropImage после этого
window.onload = function() {
    cropImage(document.querySelector(".photo__user"), 0.3, 0.3);
};