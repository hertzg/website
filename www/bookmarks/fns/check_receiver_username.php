<?php

function check_receiver_username ($mysqli, $id_users,
    $username, &$receiver_id_users, &$errors) {

    if ($username === '') {
        $errors[] = 'Enter username.';
    } else {
        include_once __DIR__.'/../../fns/Users/getByUsername.php';
        $receiverUser = Users\getByUsername($mysqli, $username);
        if (!$receiverUser) {
            $errors[] = "A user with the username doesn't exist.";
        } else {
            $receiver_id_users = $receiverUser->id_users;
            if ($receiver_id_users == $id_users) {
                $errors[] = 'You cannot send a bookmark to yourself.';
            } else {
                include_once __DIR__.'/../../fns/get_users_connection.php';
                $connection = get_users_connection($mysqli, $receiverUser, $id_users);
                if (!$connection['can_send_bookmark']) {
                    $errors[] = "The user isn't receiving bookmarks from you.";
                }
            }
        }
    }

}
