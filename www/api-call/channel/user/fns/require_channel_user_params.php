<?php

function require_channel_user_params ($mysqli, $user, $channel) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($username) = request_strings('username');

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
    $subscriberUser = Users\getByUsername($mysqli, $username);

    if (!$subscriberUser) {
        include_once "$fnsDir/ErrorJson/badRequest.php";
        ErrorJson\badRequest('"USER_NOT_FOUND"');
    }

    return $subscriberUser;

}
