<?php

include_once '../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_guest_user.php';
require_guest_user('../');

include_once '../fns/request_strings.php';
list($email) = request_strings('email');

include_once '../fns/str_collapse_spaces.php';
$email = str_collapse_spaces($email);

$errors = [];

if ($email === '') $errors[] = 'Enter email.';

if (!$errors) {

    include_once '../fns/Users/getByEmail.php';
    include_once '../lib/mysqli.php';
    $user = Users\getByEmail($mysqli, $email);

    if (!$user) {
        $errors[] = 'User with this email was not found.';
    }

}

include_once '../fns/Captcha/check.php';
Captcha\check($errors);

include_once '../fns/redirect.php';

if ($errors) {
    $_SESSION['email-reset-password/errors'] = $errors;
    $_SESSION['email-reset-password/values'] = ['email' => $email];
    redirect();
}

unset(
    $_SESSION['email-reset-password/errors'],
    $_SESSION['email-reset-password/values']
);

$key = md5(uniqid(), true);

include_once '../fns/Users/editResetPasswordKey.php';
Users\editResetPasswordKey($mysqli, $user->idusers, $key);

include_once '../fns/Captcha/reset.php';
Captcha\reset();

$href = htmlspecialchars(
    'http://zvini.com/reset-password/?'.http_build_query([
        'idusers' => $user->idusers,
        'key' => bin2hex($key)
    ])
);

$title = 'Reset Password for Zvini Account';

$html =
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
    .'</html>';

$subject = mb_encode_mimeheader($title, 'UTF-8');

$headers =
    "From: no-reply@zvini.com\r\n"
    .'Content-Type: text/html; charset=UTF-8';

mail($email, $subject, $html, $headers);

$_SESSION['sign-in/messages'] = [
    'Instructions to reset password have been sent to your email address.',
];

redirect('../sign-in/');
