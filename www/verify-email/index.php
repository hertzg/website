<?php

include_once '../fns/request_strings.php';
list($idusers, $verify_email_key) = request_strings(
    'idusers', 'verify_email_key');

$idusers = abs((int)$idusers);

include_once '../fns/redirect.php';

include_once '../fns/is_md5.php';
if (!is_md5($verify_email_key)) redirect('..');

include_once '../fns/Users/getByVerifyEmailKey.php';
include_once '../lib/mysqli.php';
$user = Users\getByVerifyEmailKey($mysqli, $idusers, $verify_email_key);

if (!$user) {
    // TODO show that the key is no longer valid
    redirect('..');
}

include_once '../fns/Users/verifyEmail.php';
Users\verifyEmail($mysqli, $idusers);

include_once '../fns/session_start_custom.php';
session_start_custom();

$_SESSION['account/index_messages'] = array('The email has been verified.');
redirect('../account/');
