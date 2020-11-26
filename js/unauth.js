$(function() {
    $("button#unauth").on("click", () => {
        //Sets cookies expire time to past date:
        document.cookie = "login= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
        document.cookie = "password= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
        //and reload page
        window.location.reload();
    });
});