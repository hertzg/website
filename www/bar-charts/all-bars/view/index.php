<?php

include_once '../../fns/require_bar.php';
include_once '../../../lib/mysqli.php';
list($bar, $id, $user) = require_bar($mysqli, '../');

$base = '../../../';
$fnsDir = '../../../fns';

include_once "$fnsDir/ItemList/itemQuery.php";
$itemQuery = ItemList\itemQuery($id);

include_once '../fns/ViewPage/create.php';
$content = ViewPage\create($bar, $scripts);

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Bar #$id", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts.compressed_js_script('confirmDialog', $base)
        .'<script type="text/javascript">'
            ."var deleteHref = '../delete/submit.php$itemQuery'"
        .'</script>'
        .'<script type="text/javascript" src="../../view-bar.js?1"></script>',
]);
