<?php

include_once '../../../lib/defaults.php';

include_once 'fns/require_bars.php';
include_once '../../lib/mysqli.php';
list($bar_chart, $id, $user) = require_bars($mysqli);

$base = '../../';
$fnsDir = '../../fns';

include_once 'fns/create_page.php';
$content = create_page($mysqli, $user, $bar_chart, $scripts);

include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "All Bars of Bar Chart #$id", $content, $base, [
    'scripts' => $scripts.compressed_js_script('confirmDialog', $base)
        .'<script type="text/javascript">'
            ."var deleteAllHref = 'delete-all/submit.php?id=$id'"
        .'</script>'
        .'<script type="text/javascript" src="index.js?2"></script>',
]);
