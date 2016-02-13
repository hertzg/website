<?php

include_once 'fns/require_points.php';
include_once '../../lib/mysqli.php';
list($place, $id, $user) = require_points($mysqli);

$base = '../../';
$fnsDir = '../../fns';

include_once 'fns/create_page.php';
include_once "$fnsDir/compressed_js_script.php";
$content =
    create_page($mysqli, $user, $place)
    .compressed_js_script('confirmDialog', $base)
    .'<script type="text/javascript">'
        ."var deleteAllHref = 'delete-all/submit.php?id=$id'"
    .'</script>'
    .'<script type="text/javascript" src="index.js?1"></script>';

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "All Points of Place #$id", $content, $base);
