<?php

include_once '../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../classes/Captcha.php';

include_once '../fns/session_start_custom.php';
session_start_custom();

include_once '../fns/request_strings.php';
list($email) = request_strings('email');

include_once '../fns/str_collapse_spaces.php';
$email = str_collapse_spaces($email);

$errors = array();

if ($email === '') $errors[] = 'Enter email.';

if (!$errors) {

    include_once '../fns/Users/getByEmail.php';
    include_once '../lib/mysqli.php';
    $user = Users\getByEmail($mysqli, $email);

    if (!$user) {
        $errors[] = 'User with this email was not found.';
    }

}

Captcha::check($errors, 3);

include_once '../fns/redirect.php';

if ($errors) {
    $_SESSION['email-reset-password/index_errors'] = $errors;
    $_SESSION['email-reset-password/index_lastpost'] = array('email' => $email);
    redirect();
}

unset(
    $_SESSION['email-reset-password/index_errors'],
    $_SESSION['email-reset-password/index_lastpost']
);

$resetpasswordkey = md5(uniqid(), true);

include_once '../fns/Users/editResetPasswordKey.php';
Users\editResetPasswordKey($mysqli, $user->idusers, $resetpasswordkey);

Captcha::reset();

$href = htmlspecialchars(
    'http://zvini.com/reset-password/?'.http_build_query(array(
        'idusers' => $user->idusers,
        'resetpasswordkey' => bin2hex($resetpasswordkey)
    ))
);

$title = 'Reset Password for Zvini Account';

mail(
    $email,
    $title,
    '<!DOCTYPE html>'
    .'<html>'
        .'<head>'
            ."<title>$title</title>"
            .'<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />'
        .'</head>'
        .'<body>'
            .'<div>'
                .'Password reset has been requested for your Zvini account.'
                .' To reset password visit the following link:'
            .'</div>'
            .'<br />'
            ."<a href=\"$href\">$href</a>"
        .'</body>'
    .'</html>',
    "From: no-reply@zvini.com\r\n"
    .'Content-Type: text/html; charset=UTF-8'
);

$_SESSION['sign-in/index_messages'] = array(
    'An email has been sent to you to reset password.',
    'Follow the instructions in it.'
);
redirect('../sign-in/');
