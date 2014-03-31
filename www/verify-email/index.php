<?php

include_once '../fns/request_strings.php';
list($id_users, $key) = request_strings('id_users', 'key');

$id_users = abs((int)$id_users);

include_once '../fns/redirect.php';

include_once '../fns/is_md5.php';
if (!is_md5($key)) redirect('..');

include_once '../fns/Users/getByVerifyEmailKey.php';
include_once '../lib/mysqli.php';
$user = Users\getByVerifyEmailKey($mysqli, $id_users, $key);

if (!$user) {
    // TODO show that the key is no longer valid
    redirect('..');
}

include_once '../fns/Users/verifyEmail.php';
Users\verifyEmail($mysqli, $id_users);

include_once '../fns/session_start_custom.php';
session_start_custom();

$_SESSION['account/messages'] = ['The email has been verified.'];
redirect('../account/');
