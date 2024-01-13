

function exit() {
    $.ajax({
        type: "POST",
        url: "/site/logout",
    });
}

function changePassword() {
    $.ajax({
        type: "POST",
        url: "/site/change-password",
    });
}