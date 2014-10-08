<?php

function check_receiver ($mysqli, $id_users,
    $username, &$receiver_id_users, &$errors) {

    include_once __DIR__.'/../../fns/get_receiver_connection.php';
    $connection = get_receiver_connection(
        $mysqli, $id_users, $username, $receiverUser, $errors);

    if ($errors) return;

    if ($connection['can_send_task']) {
        $receiver_id_users = $receiverUser->id_users;
    } else {
        $errors[] = "The user doesn't receive tasks from you.";
    }

}
