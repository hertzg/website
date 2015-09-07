<?php

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

unset(
    $_SESSION['home/customize/reorder/messages'],
    $_SESSION['home/customize/show-hide/messages'],
    $_SESSION['home/messages']
);

include_once 'fns/create_page.php';
include_once "$fnsDir/compressed_js_script.php";
$content =
    create_page()
    .compressed_js_script('confirmDialog', $base)
    .'<script type="text/javascript" defer="defer" src="index.js"></script>';

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Customize Home', $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
