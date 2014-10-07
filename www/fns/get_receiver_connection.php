<?php

function get_receiver_connection ($mysqli,
    $id_users, $username, &$receiverUser, &$errors) {

    if ($username === '') {
        $errors[] = 'Enter username.';
        return;
    }

    include_once __DIR__.'/Username/isValid.php';
    if (!Username\isValid($username)) {
        $errors[] = 'The username is invalid.';
        return;
    }

    include_once __DIR__.'/Users/getByUsername.php';
    $receiverUser = Users\getByUsername($mysqli, $username);

    if (!$receiverUser) {
        $errors[] = "A user with the username doesn't exist.";
        return;
    }

    include_once __DIR__.'/get_users_connection.php';
    return get_users_connection($mysqli, $receiverUser, $id_users);

}
