$(function () {
    $("button#unauth").on("click", () => {
        document.cookie = "login= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
        document.cookie = "password= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
        window.location.reload();
    });
});