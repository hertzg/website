<?php

include_once '../../lib/defaults.php';

include_once '../fns/signed_user.php';
$user = signed_user();

if (!$user) {
    include_once '../fns/redirect.php';
    redirect('..');
}

if (!$user->disabled) {
    include_once '../fns/redirect.php';
    redirect('../home/');
}

include_once '../fns/echo_alert_page.php';
echo_alert_page('Account Disabled',
    'Your account has been disabled.', '../sign-out/submit.php', '../');
