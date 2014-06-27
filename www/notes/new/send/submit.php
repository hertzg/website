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

    $_SESSION['notes/new/send/errors'] = $errors;
    $_SESSION['notes/new/send/values'] = ['username' => $username];

    include_once '../../../fns/ItemList/pageQuery.php';
    redirect('./'.ItemList\pageQuery());

}

unset(
    $_SESSION['notes/new/values'],
    $_SESSION['notes/new/send/errors'],
    $_SESSION['notes/new/send/values']
);

include_once '../../../fns/Users/Notes/Received/add.php';
Users\Notes\Received\add($mysqli, $id_users, $user->username,
    $receiver_id_users, $stageValues['text'], $stageValues['tags'],
    $stageValues['encrypt']);

$_SESSION['notes/messages'] = ['Sent.'];
unset($_SESSION['notes/errors']);

include_once '../../../fns/ItemList/listUrl.php';
redirect('../'.ItemList\listUrl());
