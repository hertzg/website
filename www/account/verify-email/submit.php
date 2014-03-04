<?php

include_once '../../fns/require_user.php';
require_user('../../');

include_once '../../fns/redirect.php';
if ($user->email_verified) redirect('..');

include_once '../../fns/request_strings.php';
list($captcha) = request_strings('captcha');

$errors = array();

include_once '../../classes/Captcha.php';
Captcha::check($errors);

if ($errors) {
    $_SESSION['account/verify-email/index_errors'] = $errors;
    redirect();
}

$key = md5(uniqid(), true);

include_once '../../fns/Users/editVerifyEmailKey.php';
include_once '../../lib/mysqli.php';
Users\editVerifyEmailKey($mysqli, $user->idusers, $key);

$href = htmlspecialchars(
    'http://zvini.com/verify-email/?'.http_build_query(array(
        'idusers' => $user->idusers,
        'key' => bin2hex($key),
    ))
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

$headers =
    "From: no-reply@zvini.com\r\n"
    .'Content-Type: text/html; charset=UTF-8';

mail($user->email, $title, $html, $headers);

$_SESSION['account/index_messages'] = array(
    'Instructions to verify email have been sent to your email address.',
);

redirect('..');
