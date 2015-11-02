<?php

function check_username ($mysqli, $id_users, $username,
    $address, &$connected_id_users, &$errors, $exclude_id = 0) {

    if ($username === '') {
        $errors[] = 'Enter username.';
        return;
    }

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Username/isValid.php";
    if (!Username\isValid($username)) {
        $errors[] = 'The username is invalid.';
        return;
    }

    if ($address === null) {

        include_once "$fnsDir/Users/getByUsername.php";
        $userToConnect = Users\getByUsername($mysqli, $username);

        if (!$userToConnect) {
            $errors[] = "A user with the username doesn't exist.";
            return;
        }

        $connected_id_users = $userToConnect->id_users;
        if ($connected_id_users == $id_users) {
            $errors[] = 'You cannot connect to yourself.';
            return;
        }

        include_once "$fnsDir/Connections/getByConnectedUser.php";
        $connectedUser = Connections\getByConnectedUser(
            $mysqli, $id_users, $connected_id_users, $exclude_id);

    } else {

        include_once "$fnsDir/Connections/getByUsernameAddress.php";
        $connectedUser = Connections\getByUsernameAddress(
            $mysqli, $id_users, $username, $address, $exclude_id);

    }

    if ($connectedUser) {
        $errors[] = 'A connection to this user already exists.';
    }

}
