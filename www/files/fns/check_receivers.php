<?php

function check_receivers ($mysqli, $id_users,
    array $usernames, &$receiver_id_userss, &$errors) {

    foreach ($usernames as $username) {
        include_once __DIR__.'/../../fns/Users/getByUsername.php';
        $receiverUser = Users\getByUsername($mysqli, $username);
        if (!$receiverUser) {
            $escapedUsername = htmlspecialchars($username);
            $errors[] = "The user \"$escapedUsername\" no longer exists.";
        } else {
            include_once __DIR__.'/../../fns/get_users_connection.php';
            $connection = get_users_connection(
                $mysqli, $receiverUser, $id_users);
            if ($connection['can_send_file']) {
                $receiver_id_userss[] = $receiverUser->id_users;
            } else {
                $escapedUsername = htmlspecialchars($username);
                $errors[] = "The user \"$escapedUsername\" no longer"
                    .' receives files from you.';
            }
        }
    }

}
