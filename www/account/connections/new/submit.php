<?php

include_once '../../../fns/require_user.php';
$user = require_user('../../../');

include_once '../../../fns/request_strings.php';
list($username, $can_subscribe_to_my_channel) = request_strings(
    'username', 'can_subscribe_to_my_channel');

$can_subscribe_to_my_channel = (bool)$can_subscribe_to_my_channel;

include_once '../../../fns/redirect.php';

include_once '../../../fns/Users/getByUsername.php';
include_once '../../../lib/mysqli.php';
$connectedUser = Users\getByUsername($mysqli, $username);

$errors = [];

if (!$connectedUser) {
    $errors[] = "A user with the username doesn't exist.";
} elseif ($connectedUser->idusers == $user->idusers) {
    $errors[] = 'You cannot connect to yourself.';
}

if ($errors) {
    $_SESSION['account/connections/new/index_errors'] = $errors;
    $_SESSION['account/connections/new/index_values'] = array(
        'username' => $username,
        'can_subscribe_to_my_channel' => $can_subscribe_to_my_channel,
    );
    redirect();
}

include_once '../../../fns/Connections/add.php';
Connections\add($mysqli, $user->idusers, $connectedUser->idusers,
    $username, $can_subscribe_to_my_channel);

unset(
    $_SESSION['account/connections/new/index_errors'],
    $_SESSION['account/connections/new/index_values']
);

$_SESSION['account/connections/index_messages'] = array(
    'Connection has been added.',
);

redirect('..');
