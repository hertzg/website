<?php

function request_receiver_user ($mysqli, $id_users) {

    include_once __DIR__.'/../../fns/request_strings.php';
    list($receiver_username) = request_strings('receiver_username');

    if ($receiver_username === '') {
        include_once __DIR__.'/bad_request.php';
        bad_request('ENTER_RECEIVER_USERNAME');
    }

    include_once __DIR__.'/../../fns/Users/getByUsername.php';
    $receiverUser = Users\getByUsername($mysqli, $receiver_username);

    if (!$receiverUser) {
        include_once __DIR__.'/bad_request.php';
        bad_request('RECEIVER_NOT_FOUND');
    }

    $receiver_id_users = $receiverUser->id_users;
    if ($receiver_id_users == $id_users) {
        include_once __DIR__.'/bad_request.php';
        bad_request('SENDING_TO_SELF');
    }

    include_once '../../fns/get_users_connection.php';
    $connection = get_users_connection($mysqli, $receiverUser, $id_users);
    if (!$connection['can_send_bookmark']) {
        include_once __DIR__.'/bad_request.php';
        bad_request('RECEIVER_NOT_RECEIVING');
    }

    return $receiverUser;

}
