<?php

include_once '../fns/signed_user.php';
$user = signed_user();

if (!$user) {
    include_once '../fns/redirect.php';
    redirect('..');
}

if (!$user->blocked) {
    include_once '../fns/redirect.php';
    redirect('../home/');
}

include_once '../fns/echo_alert_page.php';
echo_alert_page('Account Blocked',
    'Your account has been blocked.', '../sign-out/submit.php', '../');
