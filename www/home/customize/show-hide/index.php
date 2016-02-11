<?php

$base = '../../../';
$fnsDir = '../../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

include_once 'fns/unset_session_vars.php';
unset_session_vars();

include_once 'fns/create_page.php';
include_once "$fnsDir/compressed_js_script.php";
$content =
    create_page($user, $scripts)
    .compressed_js_script('confirmDialog', $base)
    .'<script type="text/javascript" defer="defer" src="index.js"></script>';

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Show / Hide Items', $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts,
]);
