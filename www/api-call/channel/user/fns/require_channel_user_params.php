<?php

function require_channel_user_params ($mysqli, $user, $channel) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($username) = request_strings('username');

    if ($username === '') {
        include_once __DIR__.'/../../../fns/bad_request.php';
        bad_request('ENTER_USERNAME');
    }

    include_once "$fnsDir/Username/isValid.php";
    if (!Username\isValid($username)) {
        include_once __DIR__.'/../../../fns/bad_request.php';
        bad_request('INVALID_USERNAME');
    }

    include_once "$fnsDir/Users/getByUsername.php";
    $subscriberUser = Users\getByUsername($mysqli, $username);

    if (!$subscriberUser) {
        include_once __DIR__.'/../../../fns/bad_request.php';
        bad_request('USER_NOT_FOUND');
    }

    return $subscriberUser;

}
