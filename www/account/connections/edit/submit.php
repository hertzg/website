<?php

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_connection.php';
include_once '../../../lib/mysqli.php';
list($connection, $id, $user) = require_connection($mysqli);
$id_users = $user->id_users;

include_once '../fns/request_connection_params.php';
list($username, $expires, $expire_time,
    $can_send_bookmark, $can_send_channel,
    $can_send_contact, $can_send_file, $can_send_note,
    $can_send_place, $can_send_task) = request_connection_params();

$errors = [];

include_once '../fns/check_username.php';
check_username($mysqli, $id_users, $username,
    $connected_id_users, $errors, $connection->connected_id_users);

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['account/connections/edit/errors'] = $errors;
    $_SESSION['account/connections/edit/values'] = [
        'username' => $username,
        'expires' => $expires,
        'can_send_bookmark' => $can_send_bookmark,
        'can_send_channel' => $can_send_channel,
        'can_send_contact' => $can_send_contact,
        'can_send_file' => $can_send_file,
        'can_send_note' => $can_send_note,
        'can_send_place' => $can_send_place,
        'can_send_task' => $can_send_task,
    ];
    redirect("./?id=$id");
}

unset(
    $_SESSION['account/connections/edit/errors'],
    $_SESSION['account/connections/edit/values']
);

include_once "$fnsDir/Users/Connections/edit.php";
Users\Connections\edit($mysqli, $id, $id_users, $connected_id_users, $username,
    $expire_time, $can_send_bookmark, $can_send_channel, $can_send_contact,
    $can_send_file, $can_send_note, $can_send_place, $can_send_task);

$_SESSION['account/connections/view/messages'] = ['Changes have been saved.'];

redirect("../view/?id=$id");
