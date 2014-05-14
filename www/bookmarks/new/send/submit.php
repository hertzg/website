<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once 'fns/require_stage.php';
list($user, $stageValues) = require_stage();
$id_users = $user->id_users;

include_once '../../../fns/request_strings.php';
list($username) = request_strings('username');

$errors = [];

include_once '../../fns/check_receiver_username.php';
include_once '../../../lib/mysqli.php';
check_receiver_username($mysqli, $id_users, $username, $receiver_id_users, $errors);

include_once '../../../fns/redirect.php';

if ($errors) {
    $_SESSION['bookmarks/new/send/errors'] = $errors;
    $_SESSION['bookmarks/new/send/values'] = ['username' => $username];
    redirect();
}

unset(
    $_SESSION['bookmarks/new/values'],
    $_SESSION['bookmarks/new/send/errors'],
    $_SESSION['bookmarks/new/send/values']
);

include_once '../../../fns/Users/Bookmarks/Received/add.php';
Users\Bookmarks\Received\add($mysqli, $id_users, $user->username,
    $receiver_id_users, $stageValues['url'], $stageValues['title'],
    $stageValues['tags']);

$_SESSION['bookmarks/messages'] = ['Sent.'];
unset($_SESSION['bookmarks/errors']);

redirect('../..');
