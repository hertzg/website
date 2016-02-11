<?php

function require_password_params ($username, &$password) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($password) = request_strings('password');

    if ($password === '') {
        include_once "$fnsDir/ApiCall/Error/badRequest.php";
        ApiCall\Error\badRequest('"ENTER_PASSWORD"');
    }

    include_once "$fnsDir/Password/isShort.php";
    if (Password\isShort($password)) {
        include_once "$fnsDir/ApiCall/Error/badRequest.php";
        ApiCall\Error\badRequest('"PASSWORD_TOO_SHORT"');
    }

    if ($password === $username) {
        include_once "$fnsDir/ApiCall/Error/badRequest.php";
        ApiCall\Error\badRequest('"PASSWORD_SAME"');
    }

}
