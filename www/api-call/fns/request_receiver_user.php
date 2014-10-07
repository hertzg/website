<?php

function request_receiver_user ($mysqli, $id_users, $permission) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/request_strings.php";
    list($receiver_username) = request_strings('receiver_username');

    if ($receiver_username === '') {
        include_once __DIR__.'/bad_request.php';
        bad_request('ENTER_RECEIVER_USERNAME');
    }

    include_once "$fnsDir/Username/isValid.php";
    if (!Username\isValid($receiver_username)) {
        include_once __DIR__.'/bad_request.php';
        bad_request('RECEIVER_NOT_FOUND');
    }

    include_once "$fnsDir/Users/getByUsername.php";
    $receiverUser = Users\getByUsername($mysqli, $receiver_username);

    if (!$receiverUser) {
        include_once __DIR__.'/bad_request.php';
        bad_request('RECEIVER_NOT_FOUND');
    }

    include_once "$fnsDir/get_users_connection.php";
    $connection = get_users_connection($mysqli, $receiverUser, $id_users);
    if (!$connection[$permission]) {
        include_once __DIR__.'/bad_request.php';
        bad_request('RECEIVER_NOT_RECEIVING');
    }

    return $receiverUser;

}
