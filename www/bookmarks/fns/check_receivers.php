<?php

function check_receiver ($mysqli, $id_users,
    $usernames, &$receiver_id_userss, &$errors) {

    foreach ($usernames as $username) {
        include_once __DIR__.'/../../fns/Users/getByUsername.php';
        $receiverUser = Users\getByUsername($mysqli, $username);
        if (!$receiverUser) {
            $errors[] = "The user \"".htmlspecialchars($username)."\" no longer exists.";
        } else {
            include_once __DIR__.'/../../fns/get_users_connection.php';
            $connection = get_users_connection(
                $mysqli, $receiverUser, $id_users);
            if ($connection['can_send_bookmark']) {
                $receiver_id_userss[] = $receiverUser->id_users;
            } else {
                $errors[] = "The user \"".htmlspecialchars($username)."\" isn't receiving bookmarks from you.";
            }
        }
    }

}
