<?php

function check_receivers ($mysqli, $id_users,
    $usernames, &$receiver_id_userss, &$errors) {

    $fnsDir = __DIR__.'/../../fns';
    foreach ($usernames as $username) {
        include_once "$fnsDir/Users/getByUsername.php";
        $receiverUser = Users\getByUsername($mysqli, $username);
        if ($receiverUser) {
            include_once "$fnsDir/get_users_connection.php";
            $connection = get_users_connection(
                $mysqli, $receiverUser, $id_users);
            if ($connection['can_send_bookmark']) {
                $receiver_id_userss[] = $receiverUser->id_users;
            } else {
                $escapedUsername = htmlspecialchars($username);
                $errors[] = "The user \"$escapedUsername\""
                    .' no longer receives bookmarks from you.';
            }
        } else {
            $escapedUsername = htmlspecialchars($username);
            $errors[] = "The user \"$escapedUsername\" no longer exists.";
        }
    }

}
