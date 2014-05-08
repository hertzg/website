<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../../../fns/require_user.php';
$user = require_user('../../../');
$id_users = $user->id_users;

include_once '../../../fns/request_strings.php';
list($username, $can_send_bookmark, $can_send_channel, $can_send_contact,
    $can_send_file, $can_send_note, $can_send_task) = request_strings(
    'username', 'can_send_bookmark', 'can_send_channel', 'can_send_contact',
    'can_send_file', 'can_send_note', 'can_send_task');

$can_send_bookmark = (bool)$can_send_bookmark;
$can_send_channel = (bool)$can_send_channel;
$can_send_contact = (bool)$can_send_contact;
$can_send_file = (bool)$can_send_file;
$can_send_note = (bool)$can_send_note;
$can_send_task = (bool)$can_send_task;

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
        $connected_id_users = $userToConnect->id_users;
        if ($connected_id_users == $id_users) {
            $errors[] = 'You cannot connect to yourself.';
        } else {
            include_once '../../../fns/Connections/getByConnectedUser.php';
            $connectedUser = Connections\getByConnectedUser($mysqli,
                $id_users, $connected_id_users);
            if ($connectedUser) {
                $errors[] = 'A connection to this user already exists.';
            }
        }
    }
}

if ($errors) {
    $_SESSION['account/connections/new/errors'] = $errors;
    $_SESSION['account/connections/new/values'] = [
        'username' => $username,
        'can_send_bookmark' => $can_send_bookmark,
        'can_send_channel' => $can_send_channel,
        'can_send_contact' => $can_send_contact,
        'can_send_file' => $can_send_file,
        'can_send_note' => $can_send_note,
        'can_send_task' => $can_send_task,
    ];
    redirect();
}

unset(
    $_SESSION['account/connections/new/errors'],
    $_SESSION['account/connections/new/values']
);

include_once '../../../fns/Users/Connections/add.php';
$id = Users\Connections\add($mysqli, $id_users, $connected_id_users,
    $username, $can_send_bookmark, $can_send_channel, $can_send_contact,
    $can_send_file, $can_send_note, $can_send_task);

$_SESSION['account/connections/view/messages'] = [
    'Connection has been saved.',
];

redirect("../view/?id=$id");
