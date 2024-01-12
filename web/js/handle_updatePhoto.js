function handleImageUpload()
{

    var image = document.getElementById("upload").files[0];

    var reader = new FileReader();

    reader.onload = function(e) {
        document.getElementById("display-image").src = e.target.result;
    }

    reader.readAsDataURL(image);

}

function handleImageUploadRegistration()
{
    var image = document.getElementById("upload").files[0];
    var reader = new FileReader();

    reader.onload = function(e) {
        var block = document.querySelector('.register-form__elements__block-with-photo__photo-picker');

        // Удаляем существующее изображение, если оно уже было добавлено
        var existingImage = document.getElementById('display-image');
        if (existingImage) {
            existingImage.remove();
        }

        // Создаем новый элемент изображения
        var img = document.createElement('img');
        img.src = e.target.result;
        img.className = 'user-photo';
        img.id = 'display-image';
        img.alt = 'User Photo';
        img.width = '75';
        img.height = '75';
        img.style.marginLeft = "2%"

        // Добавляем изображение в блок
        block.prepend(img);

        // Получаем имя файла из пути
        var fileName = document.getElementById('upload').value.split('\\').pop();

        // Обрезаем имя файла, если оно слишком длинное
        var maxFileNameLength = 15;
        if (fileName.length > maxFileNameLength) {
            fileName = fileName.substring(0, maxFileNameLength) + '...';
        }

        // Обновляем текст в span
        document.querySelector('.input-file span').innerText = fileName;
    };

    reader.readAsDataURL(image);
}

