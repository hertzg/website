<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_connection.php';
include_once '../../../lib/mysqli.php';
list($connection, $id, $user) = require_connection($mysqli);

include_once '../fns/request_connection_params.php';
list($username, $address, $expires, $expire_time, $can_send_bookmark,
    $can_send_calculation, $can_send_channel, $can_send_contact,
    $can_send_file, $can_send_note, $can_send_place,
    $can_send_schedule, $can_send_task) = request_connection_params();

include_once '../fns/check_username.php';
check_username($mysqli, $user->id_users, $username,
    $address, $connected_id_users, $errors, $id);

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['account/connections/edit/errors'] = $errors;
    $_SESSION['account/connections/edit/values'] = [
        'username' => $username,
        'address' => $address,
        'expires' => $expires,
        'can_send_bookmark' => $can_send_bookmark,
        'can_send_calculation' => $can_send_calculation,
        'can_send_channel' => $can_send_channel,
        'can_send_contact' => $can_send_contact,
        'can_send_file' => $can_send_file,
        'can_send_note' => $can_send_note,
        'can_send_place' => $can_send_place,
        'can_send_schedule' => $can_send_schedule,
        'can_send_task' => $can_send_task,
    ];
    redirect("./?id=$id");
}

unset(
    $_SESSION['account/connections/edit/errors'],
    $_SESSION['account/connections/edit/values']
);

include_once "$fnsDir/Users/Connections/edit.php";
Users\Connections\edit($mysqli, $connection,
    $connected_id_users, $username, $address, $expire_time,
    $can_send_bookmark, $can_send_calculation, $can_send_channel,
    $can_send_contact, $can_send_file, $can_send_note, $can_send_place,
    $can_send_schedule, $can_send_task, $changed);

if ($changed) $message = 'Changes have been saved.';
else $message = 'No changes to be saved.';
$_SESSION['account/connections/view/messages'] = [$message];

redirect("../view/?id=$id");
