<?php

$base = '../';
$fnsDir = '../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

unset(
    $_SESSION['home/messages'],
    $_SESSION['notifications/channels/errors'],
    $_SESSION['notifications/channels/messages'],
    $_SESSION['notifications/in-channel/messages'],
    $_SESSION['notifications/in-subscribed-channel/messages'],
    $_SESSION['notifications/subscribed-channels/messages']
);

include_once 'fns/create_page.php';
include_once "$fnsDir/compressed_js_script.php";
include_once '../lib/mysqli.php';
$content =
    create_page($mysqli, $user)
    .compressed_js_script('confirmDialog', $base)
    .'<script type="text/javascript" src="index.js"></script>';

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, 'Notifications', $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
