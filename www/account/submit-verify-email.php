<?php

include_once '../fns/require_user.php';
require_user('../');

include_once '../fns/redirect.php';

if ($user->email_verified) redirect();

$verify_email_key = md5(uniqid(), true);

include_once '../fns/Users/editVerifyEmailKey.php';
include_once '../lib/mysqli.php';
Users\editVerifyEmailKey($mysqli, $user->idusers, $verify_email_key);

$href = htmlspecialchars(
    'http://zvini.com/verify-email/?'.http_build_query(array(
        'idusers' => $user->idusers,
        'verify_email_key' => bin2hex($verify_email_key),
    ))
);

$title = 'Verify Zvini Account Email Address';

mail(
    $user->email,
    $title,
    '<!DOCTYPE html>'
    .'<html>'
        .'<head>'
            ."<title>$title</title>"
            .'<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />'
        .'</head>'
        .'<body>'
            .'<div>'
                .'Verification of the email address '
                .'<b>'.htmlspecialchars($user->email).'</b>'
                .' has been requested for your Zvini account.'
                .' To verify please visit the following link:'
            .'</div>'
            .'<br />'
            ."<a href=\"$href\">$href</a>"
        .'</body>'
    .'</html>',
    "From: no-reply@zvini.com\r\n"
    .'Content-Type: text/html; charset=UTF-8'
);

$_SESSION['account/index_messages'] = array(
    'An email has been sent to you to verify the email address.',
    'Follow the instructions in it.'
);

redirect();
