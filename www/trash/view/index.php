<?php

include_once '../fns/require_deleted_item.php';
include_once '../../lib/mysqli.php';
list($deletedItem, $id, $user) = require_deleted_item($mysqli, '../');

$base = '../../';
$fnsDir = '../../fns';

include_once '../fns/ViewPage/create.php';
$content = ViewPage\create($mysqli,
    $deletedItem, $user, $title, $head, $scripts);

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, $title, $content, $base, [
    'head' => $head.compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts.compressed_js_script('confirmDialog', $base)
        .'<script type="text/javascript">'
            .'var purgeHref = '.json_encode("../purge/submit.php?id=$id")
        .'</script>'
        .'<script type="text/javascript" src="index.js?2"></script>',
]);
