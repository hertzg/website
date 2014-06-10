<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('../..');

include_once 'fns/require_stage.php';
include_once '../../../lib/mysqli.php';
list($user, $stageValues, $id, $file) = require_stage($mysqli);
$id_users = $user->id_users;

include_once '../../../fns/request_strings.php';
list($username) = request_strings('username');

$errors = [];

include_once '../../fns/check_receiver.php';
check_receiver($mysqli, $id_users, $username, $receiver_id_users, $errors);

include_once '../../../fns/redirect.php';

if ($errors) {
    $_SESSION['files/rename-file/send/errors'] = $errors;
    $_SESSION['files/rename-file/send/values'] = ['username' => $username];
    redirect("./?id=$id");
}

unset(
    $_SESSION['files/rename-file/values'],
    $_SESSION['files/rename-file/send/errors'],
    $_SESSION['files/rename-file/send/values']
);

include_once '../../../fns/Files/filePath.php';
$filePath = Files\filePath($id_users, $id);

include_once '../../../fns/Users/Files/Received/add.php';
Users\Files\Received\add($mysqli, $user, $receiver_id_users,
    $stageValues['name'], $file->size, $filePath);

$_SESSION['files/view-file/messages'] = ['Sent.'];

redirect("../../view-file/?id=$id");
