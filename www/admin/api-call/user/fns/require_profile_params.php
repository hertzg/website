<?php

function require_profile_params ($mysqli, &$username, &$email, &$full_name,
    &$timezone, &$admin, &$disabled, &$expires, $exclude_id = 0) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/Username/request.php";
    $username = Username\request();

    include_once "$fnsDir/Email/request.php";
    $email = Email\request();

    include_once "$fnsDir/FullName/request.php";
    $full_name = FullName\request();

    include_once "$fnsDir/request_strings.php";
    list($timezone, $admin, $disabled, $expires) = request_strings(
        'timezone', 'admin', 'disabled', 'expires');

    $timezone = (int)$timezone;

    include_once "$fnsDir/Timezone/isValid.php";
    if (!Timezone\isValid($timezone)) $timezone = 0;

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

    if ($email !== '') {
        include_once "$fnsDir/Email/isValid.php";
        if (!Email\isValid($email)) {
            include_once "$fnsDir/ApiCall/Error/badRequest.php";
            ApiCall\Error\badRequest('"INVALID_EMAIL"');
        }
    }

}
