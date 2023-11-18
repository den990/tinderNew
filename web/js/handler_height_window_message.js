function setHeight () {
    var windowHeight = window.screen.height;

// Вычисляем 60% от высоты окна
    var sixtyPercentHeight = 0.65 * windowHeight;
// Присваиваем высоту блоку
    document.querySelector(".block__message-window").style.height = sixtyPercentHeight + "px";
    document.querySelector(".block__message-window-chat").style.height = 100 + "%";
    var svgElement = document.getElementById("mySvg");
    svgElement.querySelector("path").setAttribute("d", `M1 0V${sixtyPercentHeight}`);
}

window.onload = function ()
{
    setHeight();
}

window.addEventListener('resize', setHeight);