<?php

$base = '../';
$fnsDir = '../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

unset($_SESSION['home/messages']);

include_once 'fns/create_page.php';
include_once '../lib/mysqli.php';
$content = create_page($mysqli, $user, $scripts);

if ($user->num_deleted_items) {

    include_once "$fnsDir/compressed_js_script.php";
    $content .=
        compressed_js_script('confirmDialog', $base)
        .'<script type="text/javascript" src="index.js?1"></script>';

    include_once "$fnsDir/compressed_css_link.php";
    $head = compressed_css_link('confirmDialog', $base);

} else {
    $head = '';
}

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Trash', $content, $base, [
    'head' => $head,
    'scripts' => $scripts,
]);
