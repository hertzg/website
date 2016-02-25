<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once '../fns/require_file.php';
include_once '../../lib/mysqli.php';
list($file, $id, $user) = require_file($mysqli);

$errorsKey = 'files/send-file/errors';
$valuesKey = 'files/send-file/values';

$url = "./?id=$id";
include_once "$fnsDir/redirect.php";

if (!array_key_exists($valuesKey, $_SESSION)) redirect($url);

$recipients = $_SESSION[$valuesKey]['recipients'];
if (!$recipients) redirect($url);

include_once '../fns/check_receivers.php';
check_receivers($mysqli, $user->id_users,
    $recipients, $receiver_id_userss, $errors);

if ($errors) {
    $_SESSION[$errorsKey] = $errors;
    unset($_SESSION['files/send-file/messages']);
    redirect($url);
}

include_once "$fnsDir/Users/Files/send.php";
foreach ($receiver_id_userss as $receiver_id_users) {
    Users\Files\send($mysqli, $user, $receiver_id_users, $file);
}

unset(
    $_SESSION[$errorsKey],
    $_SESSION[$valuesKey]
);

$_SESSION['files/view-file/messages'] = ['Sent.'];
unset($_SESSION['files/view-file/errors']);

redirect("../view-file/?id=$id");
