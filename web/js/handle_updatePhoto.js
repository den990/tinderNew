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

        // Добавляем изображение в блок
        block.appendChild(img);
    };

    reader.readAsDataURL(image);

}

$('.input-file input[type=file]').on('change', function(){
    let file = this.files[0];
    $(this).next().html(file.name);
});