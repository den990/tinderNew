function setHeight () {
    var windowHeight = window.screen.height;

// Вычисляем 60% от высоты окна
    var sixtyPercentHeight = 0.65 * windowHeight;
// Присваиваем высоту блоку
    document.querySelector(".block__message-window").style.height = sixtyPercentHeight + "px";
    document.querySelector(".block__message-window-chat").style.height = 100 + "%";
    var svgElement = document.getElementById("mySvg");
    var chatElement = document.querySelector(".block__message-window-chat");
    var visibleHeight = chatElement.scrollHeight;
    svgElement.setAttribute("height", visibleHeight); // Изменено
    svgElement.querySelector("path").setAttribute("d", `M1 0V${visibleHeight}`);
}

window.onload = function ()
{
    setHeight();
}

window.addEventListener('resize', setHeight);