function setHeight () {
    var windowHeight = window.screen.height;

// Вычисляем 60% от высоты окна
    var sixtyPercentHeight = 0.55 * windowHeight;
// Присваиваем высоту блоку
    if (windowHeight > 600) {
        document.querySelector(".block__notification-window-main").style.height = sixtyPercentHeight + "px";
    }

}

window.onload = function ()
{
    setHeight();
}


window.addEventListener('resize', setHeight);