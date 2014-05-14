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
    $_SESSION['tasks/new/send/errors'] = $errors;
    $_SESSION['tasks/new/send/values'] = ['username' => $username];
    redirect();
}

unset(
    $_SESSION['tasks/new/values'],
    $_SESSION['tasks/new/send/errors'],
    $_SESSION['tasks/new/send/values']
);

include_once '../../../fns/Users/Tasks/Received/add.php';
Users\Tasks\Received\add($mysqli, $id_users, $user->username,
    $receiver_id_users, $stageValues['text'], $stageValues['top_priority'],
    $stageValues['tags']);

$_SESSION['tasks/messages'] = ['Sent.'];
unset($_SESSION['tasks/errors']);

redirect('../..');
