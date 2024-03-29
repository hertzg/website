<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_user_with_password.php';
$user = require_user_with_password('../');

$base = '../../';
$fnsDir = '../../fns';

include_once 'fns/create_page.php';
include_once '../../lib/mysqli.php';
$content = create_page($mysqli, $user, $scripts);

if ($user->num_tokens) {

    include_once "$fnsDir/compressed_js_script.php";
    $scripts .=
        compressed_js_script('confirmDialog', $base)
        .'<script type="text/javascript" src="index.js?1"></script>';

    include_once "$fnsDir/compressed_css_link.php";
    $head = compressed_css_link('confirmDialog', $base);

} else {
    $head = '';
}

unset($_SESSION['account/messages']);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Remembered Sessions', $content, $base, [
    'head' => $head,
    'scripts' => $scripts,
]);
