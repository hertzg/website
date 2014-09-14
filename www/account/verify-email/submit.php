<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');

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

unset($_SESSION['account/verify-email/errors']);

include_once '../../fns/Captcha/reset.php';
Captcha\reset();

$key = md5(uniqid(), true);

include_once '../../fns/Users/editVerifyEmailKey.php';
include_once '../../lib/mysqli.php';
Users\editVerifyEmailKey($mysqli, $user->id_users, $key);

include_once '../../fns/get_domain_name.php';
$domain_name = get_domain_name();

$href = htmlspecialchars(
    "http://$domain_name/verify-email/?".http_build_query([
        'id_users' => $user->id_users,
        'key' => bin2hex($key),
    ])
);

$title = 'Verify Zvini Account Email Address';

$html =
    '<!DOCTYPE html>'
    .'<html>'
        .'<head>'
            ."<title>$title</title>"
            .'<meta http-equiv="Content-Type"'
            .' content="text/html; charset=UTF-8" />'
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
    "From: no-reply@$domain_name\r\n"
    .'Content-Type: text/html; charset=UTF-8';

mail($user->email, $subject, $html, $headers);

$message = 'Instructions to verify email have been sent to your email address.';
$_SESSION['account/messages'] = [$message];

redirect('..');
