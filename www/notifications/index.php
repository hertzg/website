<?php

$base = '../';
$fnsDir = '../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

include_once 'fns/create_page.php';
include_once '../lib/mysqli.php';
$content = create_page($mysqli, $user, $scripts);

if ($user->num_notifications) {

    include_once "$fnsDir/compressed_js_script.php";
    $content .=
        compressed_js_script('confirmDialog', $base)
        .'<script type="text/javascript" src="index.js"></script>';

    include_once "$fnsDir/compressed_css_link.php";
    $head = compressed_css_link('confirmDialog', $base);

} else {
    $head = '';
}

include_once "$fnsDir/echo_page.php";
echo_page($user, 'Notifications', $content, $base, [
    'head' => $head,
    'scripts' => $scripts,
]);
