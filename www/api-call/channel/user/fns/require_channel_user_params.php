<?php

function require_channel_user_params ($mysqli,
    $user, $channel, &$subscriberUser) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($username) = request_strings('username');

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
    $subscriberUser = Users\getByUsername($mysqli, $username);

    if (!$subscriberUser) {
        include_once "$fnsDir/ApiCall/Error/badRequest.php";
        ApiCall\Error\badRequest('"USER_NOT_FOUND"');
    }

}
