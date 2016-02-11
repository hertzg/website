<?php

function require_profile_params ($mysqli, &$username,
    &$admin, &$disabled, &$expires, $exclude_id = 0) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/Username/request.php";
    $username = Username\request();

    include_once "$fnsDir/request_strings.php";
    list($admin, $disabled, $expires) = request_strings(
        'admin', 'disabled', 'expires');

    $admin = (bool)$admin;
    $disabled = (bool)$disabled;
    $expires = (bool)$expires;

    if ($username === '') {
        include_once "$fnsDir/ApiCall/Error/badRequest.php";
        ApiCall\Error\badRequest('"ENTER_USERNAME"');
    }

    include_once "$fnsDir/Username/isValid.php";
    if (!Username\isValid($username)) {
        include_once "$fnsDir/ApiCall/Error/badRequest.php";
        ApiCall\Error\badRequest('"INVALID_USERNAME"');
    }

    include_once "$fnsDir/Users/getByUsername.php";
    if (Users\getByUsername($mysqli, $username, $exclude_id)) {
        include_once "$fnsDir/ApiCall/Error/badRequest.php";
        ApiCall\Error\badRequest('"USERNAME_UNAVAILABLE"');
    }

}
