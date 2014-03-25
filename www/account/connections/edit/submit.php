<?php

include_once '../fns/require_connection.php';
include_once '../../../lib/mysqli.php';
list($connection, $id, $user) = require_connection($mysqli);

include_once '../../../fns/request_strings.php';
list($username, $can_subscribe_to_my_channel) = request_strings(
    'username', 'can_subscribe_to_my_channel');

$can_subscribe_to_my_channel = (bool)$can_subscribe_to_my_channel;

$errors = [];

if ($username === '') {
    $errors[] = 'Enter username.';
} else {
    include_once '../../../fns/Users/getByUsername.php';
    $connectedUser = Users\getByUsername($mysqli, $username);
    if (!$connectedUser) {
        $errors[] = "A user with the username doesn't exist.";
    } elseif ($connectedUser->idusers == $user->idusers) {
        $errors[] = 'You cannot connect to yourself.';
    }
}

include_once '../../../fns/redirect.php';

if ($errors) {
    $_SESSION['account/connections/edit/index_errors'] = $errors;
    $_SESSION['account/connections/edit/index_values'] = [
        'username' => $username,
        'can_subscribe_to_my_channel' => $can_subscribe_to_my_channel,
    ];
    redirect("./?id=$id");
}

include_once '../../../fns/Connections/edit.php';
Connections\edit($mysqli, $id, $connectedUser->idusers,
    $connectedUser->username, $can_subscribe_to_my_channel);

$_SESSION['account/connections/view/index_messages'] = [
    'Changes have been saved.',
];
redirect("../view/?id=$id");
