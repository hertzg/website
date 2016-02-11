<?php

function require_sender_and_receiver ($mysqli, $permission,
    $sender_address, &$sender_username, &$receiver_user) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/request_strings.php";
    list($sender_username, $receiver_username) = request_strings(
        'sender_username', 'receiver_username');

    if ($sender_username === '') {
        include_once "$fnsDir/ApiCall/Error/badRequest.php";
        ApiCall\Error\badRequest('"ENTER_SENDER_USERNAME"');
    }

    include_once "$fnsDir/Username/isValid.php";
    if (!Username\isValid($sender_username)) {
        include_once "$fnsDir/ApiCall/Error/badRequest.php";
        ApiCall\Error\badRequest('"INVALID_SENDER_USERNAME"');
    }

    if ($receiver_username === '') {
        include_once "$fnsDir/ApiCall/Error/badRequest.php";
        ApiCall\Error\badRequest('"ENTER_RECEIVER_USERNAME"');
    }

    if (!Username\isValid($receiver_username)) {
        include_once "$fnsDir/ApiCall/Error/badRequest.php";
        ApiCall\Error\badRequest('"INVALID_RECEIVER_USERNAME"');
    }

    include_once "$fnsDir/Users/getByUsername.php";
    $receiver_user = Users\getByUsername($mysqli, $receiver_username);

    if (!$receiver_user) {
        include_once "$fnsDir/ApiCall/Error/badRequest.php";
        ApiCall\Error\badRequest('"RECEIVER_NOT_FOUND"');
    }

    include_once "$fnsDir/get_users_external_connection.php";
    $connection = get_users_external_connection($mysqli,
        $receiver_user, $sender_username, $sender_address);
    if (!$connection[$permission]) {
        include_once "$fnsDir/ApiCall/Error/badRequest.php";
        ApiCall\Error\badRequest('"RECEIVER_NOT_RECEIVING"');
    }

}
