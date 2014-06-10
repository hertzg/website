<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('../..');

include_once 'fns/require_stage.php';
include_once '../../../lib/mysqli.php';
list($user, $stageValues, $id) = require_stage($mysqli);
$id_users = $user->id_users;

include_once '../../../fns/request_strings.php';
list($username) = request_strings('username');

$errors = [];

include_once '../../fns/check_receiver.php';
include_once '../../../lib/mysqli.php';
check_receiver($mysqli, $id_users, $username, $receiver_id_users, $errors);

include_once '../../../fns/redirect.php';

if ($errors) {
    $_SESSION['contacts/edit/send/errors'] = $errors;
    $_SESSION['contacts/edit/send/values'] = ['username' => $username];
    redirect();
}

unset(
    $_SESSION['contacts/edit/values'],
    $_SESSION['contacts/edit/send/errors'],
    $_SESSION['contacts/edit/send/values']
);

$day = $stageValues['birthday_day'];
if ($day) {
    $birthday_time = mktime(0, 0, 0, $stageValues['birthday_month'],
        $day, $stageValues['birthday_year']);
} else {
    $birthday_time = null;
}

include_once '../../../fns/Users/Contacts/Received/add.php';
Users\Contacts\Received\add($mysqli, $id_users, $user->username,
    $receiver_id_users, $stageValues['full_name'], $stageValues['alias'],
    $stageValues['address'], $stageValues['email'], $stageValues['phone1'],
    $stageValues['phone2'], $birthday_time, $stageValues['username'],
    $stageValues['tags'], $stageValues['favorite']);

$_SESSION['contacts/view/messages'] = ['Sent.'];

redirect("../../view/?id=$id");
