

function exit() {
    $.ajax({
        type: "POST",
        url: "/site/logout",
    });
}