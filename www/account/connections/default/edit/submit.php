<?php

include_once '../fns/require_connection.php';
include_once '../../../lib/mysqli.php';
list($connection, $id, $user) = require_connection($mysqli);
$idusers = $user->idusers;

include_once '../../../fns/request_strings.php';
list($username, $can_send_channel) = request_strings(
    'username', 'can_send_channel');

$can_send_channel = (bool)$can_send_channel;

$errors = [];

if ($username === '') {
    $errors[] = 'Enter username.';
} else {
    include_once '../../../fns/Users/getByUsername.php';
    $userToConnect = Users\getByUsername($mysqli, $username);
    if (!$userToConnect) {
        $errors[] = "A user with the username doesn't exist.";
    } else {
        $connected_id_users = $userToConnect->idusers;
        if ($connected_id_users == $idusers) {
            $errors[] = 'You cannot connect to yourself.';
        } else {
            include_once '../../../fns/Connections/getByConnectedUser.php';
            $connectedUser = Connections\getByConnectedUser($mysqli,
                $idusers, $connected_id_users, $connection->connected_id_users);
            if ($connectedUser) {
                $errors[] = 'A connection to this user already exists.';
            }
        }
    }
}

include_once '../../../fns/redirect.php';

if ($errors) {
    $_SESSION['account/connections/edit/index_errors'] = $errors;
    $_SESSION['account/connections/edit/index_values'] = [
        'username' => $username,
        'can_send_channel' => $can_send_channel,
    ];
    redirect("./?id=$id");
}

include_once '../../../fns/Connections/edit.php';
Connections\edit($mysqli, $id, $connected_id_users,
    $username, $can_send_channel);

$_SESSION['account/connections/view/index_messages'] = [
    'Changes have been saved.',
];
redirect("../view/?id=$id");
