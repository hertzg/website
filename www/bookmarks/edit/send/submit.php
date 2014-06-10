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
    $_SESSION['bookmarks/edit/send/errors'] = $errors;
    $_SESSION['bookmarks/edit/send/values'] = ['username' => $username];
    redirect("./?id=$id");
}

unset(
    $_SESSION['bookmarks/edit/values'],
    $_SESSION['bookmarks/edit/send/errors'],
    $_SESSION['bookmarks/edit/send/values']
);

include_once '../../../fns/Users/Bookmarks/Received/add.php';
Users\Bookmarks\Received\add($mysqli, $id_users, $user->username,
    $receiver_id_users, $stageValues['url'], $stageValues['title'],
    $stageValues['tags']);

$_SESSION['bookmarks/view/messages'] = ['Sent.'];

redirect("../../view/?id=$id");
