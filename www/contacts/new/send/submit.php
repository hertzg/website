<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once 'fns/require_stage.php';
list($user, $stageValues) = require_stage();
$id_users = $user->id_users;

include_once '../../../fns/request_strings.php';
list($username) = request_strings('username');

$errors = [];

include_once '../../fns/check_receiver.php';
include_once '../../../lib/mysqli.php';
check_receiver($mysqli, $id_users, $username, $receiver_id_users, $errors);

include_once '../../../fns/redirect.php';

if ($errors) {
    $_SESSION['contacts/new/send/errors'] = $errors;
    $_SESSION['contacts/new/send/values'] = ['username' => $username];
    redirect();
}

unset(
    $_SESSION['contacts/new/values'],
    $_SESSION['contacts/new/send/errors'],
    $_SESSION['contacts/new/send/values']
);

include_once '../../../fns/Users/Contacts/Received/add.php';
Users\Contacts\Received\add($mysqli, $id_users, $user->username,
    $receiver_id_users, $stageValues['full_name'], $stageValues['alias'],
    $stageValues['address'], $stageValues['email'], $stageValues['phone1'],
    $stageValues['phone2'], $stageValues['birthday_time'],
    $stageValues['username'], $stageValues['tags'], $stageValues['favorite']);

$_SESSION['contacts/messages'] = ['Sent.'];
unset($_SESSION['contacts/errors']);

redirect('../..');
