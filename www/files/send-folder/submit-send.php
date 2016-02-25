<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once '../fns/require_folder.php';
include_once '../../lib/mysqli.php';
list($folder, $id, $user) = require_folder($mysqli);

$errorsKey = 'files/send-folder/errors';
$valuesKey = 'files/send-folder/values';

$url = "./?id_folders=$id";
include_once "$fnsDir/redirect.php";

if (!array_key_exists($valuesKey, $_SESSION)) redirect($url);

$recipients = $_SESSION[$valuesKey]['recipients'];
if (!$recipients) redirect($url);

include_once '../fns/check_receivers.php';
check_receivers($mysqli, $user->id_users,
    $recipients, $receiver_id_userss, $errors);

if ($errors) {
    $_SESSION[$errorsKey] = $errors;
    unset($_SESSION['files/send-folder/messages']);
    redirect($url);
}

include_once "$fnsDir/Users/Folders/send.php";
foreach ($receiver_id_userss as $receiver_id_users) {
    Users\Folders\send($mysqli, $user, $receiver_id_users, $folder);
}

unset(
    $_SESSION[$errorsKey],
    $_SESSION[$valuesKey]
);

$_SESSION['files/id_folders'] = $id;
$_SESSION['files/messages'] = ['Sent.'];

redirect("../?id_folders=$id");
