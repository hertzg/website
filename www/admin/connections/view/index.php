<?php

include_once '../fns/require_connection.php';
include_once '../../../lib/mysqli.php';
list($connection, $id, $admin_user) = require_connection($mysqli);

$base = '../../../';
$fnsDir = '../../../fns';

include_once "$fnsDir/ItemList/itemQuery.php";
$itemQuery = ItemList\itemQuery($id);

include_once '../fns/ViewPage/create.php';
include_once "$fnsDir/compressed_js_script.php";
$content =
    ViewPage\create($mysqli, $connection, $scripts)
    .compressed_js_script('confirmDialog', $base)
    .'<script type="text/javascript">'
        .'var deleteHref = '.json_encode("../delete/submit.php$itemQuery")
    .'</script>'
    .'<script type="text/javascript" src="index.js"></script>';

include_once '../../fns/echo_admin_page.php';
include_once "$fnsDir/compressed_css_link.php";
echo_admin_page($admin_user, "Connection #$id", $content, '../../', [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts,
]);
