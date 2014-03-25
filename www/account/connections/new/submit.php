<?php

include_once '../../../fns/require_user.php';
$user = require_user('../../../');
$idusers = $user->idusers;

include_once '../../../fns/request_strings.php';
list($username, $can_send_channel) = request_strings(
    'username', 'can_send_channel');

$can_send_channel = (bool)$can_send_channel;

include_once '../../../fns/redirect.php';

$errors = [];

if ($username === '') {
    $errors[] = 'Enter username.';
} else {
    include_once '../../../fns/Users/getByUsername.php';
    include_once '../../../lib/mysqli.php';
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
                $idusers, $connected_id_users);
            if ($connectedUser) {
                $errors[] = 'A connection to this user already exists.';
            }
        }
    }
}

if ($errors) {
    $_SESSION['account/connections/new/errors'] = $errors;
    $_SESSION['account/connections/new/values'] = array(
        'username' => $username,
        'can_send_channel' => $can_send_channel,
    );
    redirect();
}

include_once '../../../fns/Connections/add.php';
Connections\add($mysqli, $idusers, $connected_id_users,
    $username, $can_send_channel);

unset(
    $_SESSION['account/connections/new/errors'],
    $_SESSION['account/connections/new/values']
);

$_SESSION['account/connections/messages'] = array(
    'Connection has been added.',
);

redirect('..');
