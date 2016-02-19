<?php

include_once '../../fns/require_point.php';
include_once '../../../lib/mysqli.php';
list($point, $id, $user) = require_point($mysqli, '../');

$base = '../../../';
$fnsDir = '../../../fns';

include_once "$fnsDir/ItemList/itemQuery.php";
$itemQuery = ItemList\itemQuery($id);

include_once '../fns/create_view_page.php';
$content = create_view_page($point, $scripts);

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Point #$id", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts.compressed_js_script('confirmDialog', $base)
        .'<script type="text/javascript">'
            // TOTO escape itemQuery variable
            ."var deleteHref = '../delete/submit.php$itemQuery'"
        .'</script>'
        .'<script type="text/javascript" src="../../view-point.js?1"></script>',
]);
