<?php

function require_profile_params ($mysqli,
    &$username, &$disabled, &$expires, $exclude_id = 0) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/Username/request.php";
    $username = Username\request();

    include_once "$fnsDir/request_strings.php";
    list($disabled, $expires) = request_strings('disabled', 'expires');

    $disabled = (bool)$disabled;
    $expires = (bool)$expires;

    if ($username === '') {
        include_once "$fnsDir/ErrorJson/badRequest.php";
        ErrorJson\badRequest('"ENTER_USERNAME"');
    }

    include_once "$fnsDir/Username/isValid.php";
    if (!Username\isValid($username)) {
        include_once "$fnsDir/ErrorJson/badRequest.php";
        ErrorJson\badRequest('"INVALID_USERNAME"');
    }

    include_once "$fnsDir/Users/getByUsername.php";
    if (Users\getByUsername($mysqli, $username, $exclude_id)) {
        include_once "$fnsDir/ErrorJson/badRequest.php";
        ErrorJson\badRequest('"USERNAME_UNAVAILABLE"');
    }

}
