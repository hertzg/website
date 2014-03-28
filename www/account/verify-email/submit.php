<?php

include_once '../../fns/require_user.php';
$user = require_user('../../');
$idusers = $user->idusers;

include_once '../../fns/redirect.php';
if ($user->email_verified) redirect('..');

include_once '../../fns/request_strings.php';
list($captcha) = request_strings('captcha');

$errors = [];

include_once '../../fns/Captcha/check.php';
Captcha\check($errors);

if ($errors) {
    $_SESSION['account/verify-email/errors'] = $errors;
    redirect();
}

include_once '../../fns/Captcha/reset.php';
Captcha\reset();

$key = md5(uniqid(), true);

include_once '../../fns/Users/editVerifyEmailKey.php';
include_once '../../lib/mysqli.php';
Users\editVerifyEmailKey($mysqli, $user->idusers, $key);

$href = htmlspecialchars(
    'http://zvini.com/verify-email/?'.http_build_query([
        'idusers' => $user->idusers,
        'key' => bin2hex($key),
    ])
);

$title = 'Verify Zvini Account Email Address';

$html =
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
    .'</html>';

$subject = mb_encode_mimeheader($title, 'UTF-8');

$headers =
    "From: no-reply@zvini.com\r\n"
    .'Content-Type: text/html; charset=UTF-8';

mail($user->email, $subject, $html, $headers);

$_SESSION['account/messages'] = [
    'Instructions to verify email have been sent to your email address.',
];

redirect('..');
