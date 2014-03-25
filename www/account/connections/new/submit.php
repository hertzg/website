<?php

include_once '../../../fns/require_user.php';
$user = require_user('../../../');

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
    $connectedUser = Users\getByUsername($mysqli, $username);
    if (!$connectedUser) {
        $errors[] = "A user with the username doesn't exist.";
    } elseif ($connectedUser->idusers == $user->idusers) {
        $errors[] = 'You cannot connect to yourself.';
    }
}

if ($errors) {
    $_SESSION['account/connections/new/index_errors'] = $errors;
    $_SESSION['account/connections/new/index_values'] = array(
        'username' => $username,
        'can_send_channel' => $can_send_channel,
    );
    redirect();
}

include_once '../../../fns/Connections/add.php';
Connections\add($mysqli, $user->idusers, $connectedUser->idusers,
    $username, $can_send_channel);

unset(
    $_SESSION['account/connections/new/index_errors'],
    $_SESSION['account/connections/new/index_values']
);

$_SESSION['account/connections/index_messages'] = array(
    'Connection has been added.',
);

redirect('..');
