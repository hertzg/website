(function () {
    var username = document.getElementById('username');
    if (!username.value) username.focus();
    else document.getElementById('password').focus();
})();
