<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once "$fnsDir/require_user.php";
$user = require_user('../../../');
$id_users = $user->id_users;

include_once '../fns/request_connection_params.php';
list($username, $address, $expires, $expire_time, $can_send_bookmark,
    $can_send_calculation, $can_send_channel, $can_send_contact,
    $can_send_file, $can_send_note, $can_send_place,
    $can_send_schedule, $can_send_task) = request_connection_params();

include_once '../fns/check_username.php';
include_once '../../../lib/mysqli.php';
check_username($mysqli, $id_users, $username,
    $address, $connected_id_users, $errors);

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['account/connections/new/errors'] = $errors;
    $_SESSION['account/connections/new/values'] = [
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
    redirect();
}

unset(
    $_SESSION['account/connections/new/errors'],
    $_SESSION['account/connections/new/values']
);

include_once "$fnsDir/Users/Connections/add.php";
$id = Users\Connections\add($mysqli, $id_users,
    $connected_id_users, $username, $address, $expire_time,
    $can_send_bookmark, $can_send_calculation, $can_send_channel,
    $can_send_contact, $can_send_file, $can_send_note,
    $can_send_place, $can_send_schedule, $can_send_task);

$_SESSION['account/connections/view/messages'] = ['Connection has been saved.'];

redirect("../view/?id=$id");
