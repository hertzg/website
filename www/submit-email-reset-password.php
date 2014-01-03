<?php

include_once 'lib/sameDomainReferer.php';
include_once 'fns/redirect.php';
if (!$sameDomainReferer) redirect();
include_once 'fns/request_strings.php';
include_once 'fns/str_collapse_spaces.php';
include_once 'classes/Captcha.php';
include_once 'classes/Users.php';
include_once 'lib/session-start.php';

list($email) = request_strings('email');

$email = str_collapse_spaces($email);

$errors = array();

if ($email === '') $errors[] = 'Enter email.';

if (!$errors) {
    $user = Users::getByEmail($email);
    if (!$user) {
        $errors[] = 'User with this email was not found.';
    }
}

Captcha::check($errors, 3);

unset($_SESSION['email-reset-password_errors']);

if ($errors) {
    $_SESSION['email-reset-password_errors'] = $errors;
    $_SESSION['email-reset-password_lastpost'] = array('email' => $email);
    redirect('email-reset-password.php');
}

$resetpasswordkey = md5(uniqid(), true);
Users::editResetPasswordKey($user->idusers, $resetpasswordkey);
Captcha::reset();

$href = htmlspecialchars(
    'http://zvini.com/reset-password.php?'.http_build_query(array(
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

$_SESSION['signin_messages'] = array(
    'An email has been sent to you to reset password.',
    'Follow the instructions in it.'
);
redirect('signin.php');
