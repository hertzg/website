<?php

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once "$fnsDir/require_user.php";
$user = require_user('../../');
$id_users = $user->id_users;

include_once "$fnsDir/redirect.php";
if ($user->email_verified) redirect('..');

include_once "$fnsDir/request_strings.php";
list($captcha) = request_strings('captcha');

include_once "$fnsDir/Captcha/check.php";
Captcha\check($errors);

if ($errors) {
    $_SESSION['account/verify-email/errors'] = $errors;
    redirect();
}

unset($_SESSION['account/verify-email/errors']);

include_once "$fnsDir/Captcha/reset.php";
Captcha\reset();

include_once "$fnsDir/Users/maxLengths.php";
$key = openssl_random_pseudo_bytes(Users\maxLengths()['verify_email_key']);

include_once "$fnsDir/Users/editVerifyEmailKey.php";
include_once '../../lib/mysqli.php';
Users\editVerifyEmailKey($mysqli, $id_users, $key);

include_once "$fnsDir/DomainName/get.php";
$domainName = DomainName\get();

include_once "$fnsDir/SiteBase/get.php";
$siteBase = SiteBase\get();

$href = htmlspecialchars(
    "http://$domainName{$siteBase}verify-email/?".http_build_query([
        'id_users' => $id_users,
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
    "From: no-reply@$domainName\r\n"
    .'Content-Type: text/html; charset=UTF-8';

mail($user->email, $subject, $html, $headers);

$message = 'Instructions to verify email have been sent to your email address.';
$_SESSION['account/messages'] = [$message];

redirect('..');
