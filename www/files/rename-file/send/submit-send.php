<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('../..');

include_once 'fns/require_stage.php';
include_once '../../../lib/mysqli.php';
list($user, $stageValues, $id, $file) = require_stage($mysqli);
$id_users = $user->id_users;

$errorsKey = 'files/rename-file/send/errors';
$valuesKey = 'files/rename-file/send/values';

$url = "./?id=$id";
include_once '../../../fns/redirect.php';

if (!array_key_exists($valuesKey, $_SESSION)) redirect($url);

$recipients = $_SESSION[$valuesKey]['recipients'];
if (!$recipients) redirect($url);

include_once '../../fns/check_receivers.php';
check_receivers($mysqli, $id_users,
    $recipients, $receiver_id_userss, $errors);

if ($errors) {
    $_SESSION[$errorsKey] = $errors;
    unset($_SESSION['files/rename-file/send/messages']);
    redirect($url);
}

include_once '../../../fns/Files/File/path.php';
$filePath = Files\File\path($id_users, $id);

include_once '../../../fns/Users/Files/Received/add.php';
foreach ($receiver_id_userss as $receiver_id_users) {
    Users\Files\Received\add($mysqli, $user, $receiver_id_users,
        $stageValues['name'], $file->size, $filePath);
}

unset(
    $_SESSION[$errorsKey],
    $_SESSION[$valuesKey]
);

$_SESSION['files/view-file/messages'] = ['Sent.'];

redirect("../../view-file/?id=$id");
