<?php

include_once 'fns/require_events.php';
$user = require_events();

$base = '../../';
$fnsDir = '../../fns';

include_once 'fns/create_page.php';
include_once "$fnsDir/compressed_js_script.php";
include_once '../../lib/mysqli.php';
$content =
    create_page($mysqli, $user)
    .compressed_js_script('confirmDialog', $base)
    .'<script type="text/javascript" defer="defer" src="index.js"></script>';

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, 'All Events', $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
