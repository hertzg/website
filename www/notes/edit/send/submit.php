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
check_receiver($mysqli, $id_users, $username, $receiver_id_users, $errors);

include_once '../../../fns/redirect.php';

if ($errors) {
    $_SESSION['notes/edit/send/errors'] = $errors;
    $_SESSION['notes/edit/send/values'] = ['username' => $username];
    redirect("./?id=$id");
}

unset(
    $_SESSION['notes/edit/values'],
    $_SESSION['notes/edit/send/errors'],
    $_SESSION['notes/edit/send/values']
);

include_once '../../../fns/Users/Notes/Received/add.php';
Users\Notes\Received\add($mysqli, $id_users, $user->username,
    $receiver_id_users, $stageValues['text'], $stageValues['tags'],
    $stageValues['encrypt']);

$_SESSION['notes/view/messages'] = ['Sent.'];

redirect("../../view/?id=$id");
