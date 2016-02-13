<?php

include_once '../fns/require_user.php';
include_once '../../../lib/mysqli.php';
list($user, $id, $admin_user) = require_user($mysqli);

$base = '../../../';
$fnsDir = '../../../fns';

include_once "$fnsDir/ItemList/itemQuery.php";
$itemQuery = ItemList\itemQuery($id);

include_once '../fns/ViewPage/create.php';
$content = ViewPage\create($user, $scripts);

include_once '../../fns/echo_admin_page.php';
include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/compressed_js_script.php";
echo_admin_page($admin_user, "User #$id", $content, '../../', [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts.compressed_js_script('confirmDialog', $base)
        .'<script type="text/javascript">'
            .'var deleteHref = '.json_encode("../delete/submit.php$itemQuery")
        .'</script>'
        .'<script type="text/javascript" src="index.js"></script>',
]);
