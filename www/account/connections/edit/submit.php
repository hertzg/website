<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_connection.php';
include_once '../../../lib/mysqli.php';
list($connection, $id, $user) = require_connection($mysqli);
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

$errors = [];

if ($username === '') {
    $errors[] = 'Enter username.';
} else {
    include_once '../../../fns/Users/getByUsername.php';
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
                $id_users, $connected_id_users, $connection->connected_id_users);
            if ($connectedUser) {
                $errors[] = 'A connection to this user already exists.';
            }
        }
    }
}

include_once '../../../fns/redirect.php';

if ($errors) {
    $_SESSION['account/connections/edit/errors'] = $errors;
    $_SESSION['account/connections/edit/values'] = [
        'username' => $username,
        'can_send_bookmark' => $can_send_bookmark,
        'can_send_channel' => $can_send_channel,
        'can_send_contact' => $can_send_contact,
        'can_send_file' => $can_send_file,
        'can_send_note' => $can_send_note,
        'can_send_task' => $can_send_task,
    ];
    redirect("./?id=$id");
}

include_once '../../../fns/Connections/edit.php';
Connections\edit($mysqli, $id, $connected_id_users, $username,
    $can_send_bookmark, $can_send_channel, $can_send_contact,
    $can_send_file, $can_send_note, $can_send_task);

$_SESSION['account/connections/view/messages'] = [
    'Changes have been saved.',
];
redirect("../view/?id=$id");
