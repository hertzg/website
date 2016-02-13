<?php

include_once '../fns/require_events.php';
$user = require_events('../');

$base = '../../../';
$fnsDir = '../../../fns';

include_once '../fns/SearchPage/create.php';
include_once '../../../lib/mysqli.php';
$content = SearchPage\create($mysqli, $user, $scripts);

include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'All Events', $content, $base, [
    'scripts' => $scripts.compressed_js_script('confirmDialog', $base)
        .'<script type="text/javascript">'
            ."var deleteAllHref = '../delete-all/submit.php'"
        .'</script>'
        .'<script type="text/javascript" src="../index.js?2"></script>',
]);
