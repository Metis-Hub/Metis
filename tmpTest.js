window.onload = function () {
    if (window.sessionStorage.getItem("reload") != true)
    {
        window.sessionStorage.setItem("reload", true);
        document.location.reload();
    }
}