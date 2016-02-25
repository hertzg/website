<?php

include_once '../../lib/defaults.php';

include_once '../fns/request_strings.php';
list($id_users) = request_strings('id_users');

$id_users = abs((int)$id_users);

include_once '../fns/LinkKey/request.php';
$key = LinkKey\request();

include_once '../fns/Users/getByVerifyEmailKey.php';
include_once '../lib/mysqli.php';
$user = Users\getByVerifyEmailKey($mysqli, $id_users, $key);

if (!$user) {
    include_once '../fns/echo_alert_page.php';
    echo_alert_page('Expired Link',
        'The link has expired. You should try again to verify your email.',
        '..', '../');
}

include_once '../fns/Users/Email/verify.php';
Users\Email\verify($mysqli, $id_users);

include_once '../fns/session_start_custom.php';
session_start_custom($new);

$_SESSION['account/messages'] = ['The email has been verified.'];

include_once '../fns/redirect.php';
redirect('../account/');
