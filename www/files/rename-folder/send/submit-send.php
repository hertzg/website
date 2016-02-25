<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('../..');

include_once 'fns/require_stage.php';
include_once '../../../lib/mysqli.php';
list($user, $stageValues, $id, $folder) = require_stage($mysqli);
$id_users = $user->id_users;

$errorsKey = 'files/rename-folder/send/errors';
$valuesKey = 'files/rename-folder/send/values';

$url = "./?id_folders=$id";
include_once "$fnsDir/redirect.php";

if (!array_key_exists($valuesKey, $_SESSION)) redirect($url);

$recipients = $_SESSION[$valuesKey]['recipients'];
if (!$recipients) redirect($url);

include_once '../../fns/check_receivers.php';
check_receivers($mysqli, $id_users,
    $recipients, $receiver_id_userss, $errors);

if ($errors) {
    $_SESSION[$errorsKey] = $errors;
    unset($_SESSION['files/rename-folder/send/messages']);
    redirect($url);
}

include_once "$fnsDir/Users/Folders/sendRenamed.php";
foreach ($receiver_id_userss as $receiver_id_users) {
    Users\Folders\sendRenamed($mysqli, $user,
        $receiver_id_users, $folder, $stageValues['name']);
}

unset(
    $_SESSION[$errorsKey],
    $_SESSION[$valuesKey]
);

$_SESSION['files/id_folders'] = $id;
$_SESSION['files/messages'] = ['Sent.'];

redirect("../../?id_folders=$id");
