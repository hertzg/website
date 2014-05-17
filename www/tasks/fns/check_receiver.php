<?php

function check_receiver ($mysqli, $id_users,
    $username, &$receiver_id_users, &$errors) {

    if ($username === '') {
        $errors[] = 'Enter username.';
    } else {
        include_once __DIR__.'/../../fns/Users/getByUsername.php';
        $receiverUser = Users\getByUsername($mysqli, $username);
        if (!$receiverUser) {
            $errors[] = "A user with the username doesn't exist.";
        } else {
            include_once __DIR__.'/../../fns/get_users_connection.php';
            $connection = get_users_connection($mysqli, $receiverUser, $id_users);
            if ($connection['can_send_task']) {
                $receiver_id_users = $receiverUser->id_users;
            } else {
                $errors[] = "The user isn't receiving tasks from you.";
            }
        }
    }

}
