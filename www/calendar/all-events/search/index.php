<?php

include_once '../fns/require_events.php';
$user = require_events('../');

$base = '../../../';
$fnsDir = '../../../fns';

include_once '../fns/SearchPage/create.php';
include_once "$fnsDir/compressed_js_script.php";
include_once '../../../lib/mysqli.php';
$content =
    SearchPage\create($mysqli, $user, $scripts)
    .compressed_js_script('confirmDialog', $base)
    .'<script type="text/javascript">'
        ."var deleteAllHref = '../delete-all/submit.php'"
    .'</script>'
    .'<script type="text/javascript" defer="defer" src="../index.js?2">'
    .'</script>';

include_once "$fnsDir/echo_page.php";
echo_page($user, 'All Events', $content, $base, [
    'scripts' => $scripts,
]);