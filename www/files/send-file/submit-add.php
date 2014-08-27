<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_file.php';
include_once '../../lib/mysqli.php';
list($file, $id, $user) = require_file($mysqli);

$errorsKey = 'files/send-file/errors';
$messagesKey = 'files/send-file/messages';
$valuesKey = 'files/send-file/values';

include_once '../../fns/request_strings.php';
list($username) = request_strings('username');
$username = preg_replace('/\s+/', '', $username);

$url = "./?id=$id";

if (!array_key_exists($valuesKey, $_SESSION)) {
    $_SESSION[$valuesKey] = [
        'recipients' => [],
        'username' => '',
        'usernameError' => false,
    ];
}

include_once '../../fns/redirect.php';

if (array_key_exists($username, $_SESSION[$valuesKey]['recipients'])) {
    unset($_SESSION[$errorsKey]);
    $_SESSION[$messagesKey] = ['The recipient is already added.'];
    $_SESSION[$valuesKey]['username'] = '';
    $_SESSION[$valuesKey]['usernameError'] = false;
    redirect($url);
}

include_once '../fns/check_receiver.php';
check_receiver($mysqli, $user->id_users,
    $username, $receiver_id_users, $errors);

if ($errors) {
    unset($_SESSION[$messagesKey]);
    $_SESSION[$errorsKey] = $errors;
    $_SESSION[$valuesKey]['username'] = $username;
    $_SESSION[$valuesKey]['usernameError'] = true;
    redirect($url);
}

unset($_SESSION[$errorsKey]);
$_SESSION[$valuesKey]['recipients'][$username] = $username;
$_SESSION[$valuesKey]['username'] = '';
$_SESSION[$valuesKey]['usernameError'] = false;
$_SESSION[$messagesKey] = ['The recipient has been added.'];
redirect($url);
