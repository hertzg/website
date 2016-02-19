<?php

include_once '../fns/require_api_key.php';
include_once '../../../lib/mysqli.php';
list($apiKey, $id, $user) = require_api_key($mysqli);

$base = '../../../';
$fnsDir = '../../../fns';

include_once "$fnsDir/ItemList/itemQuery.php";
$itemQuery = ItemList\itemQuery($id);

include_once '../fns/ViewPage/create.php';
$content = ViewPage\create($mysqli, $apiKey, $scripts);

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "API Key #$id", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts.compressed_js_script('confirmDialog', $base)
        .'<script type="text/javascript">'
            .'var deleteHref = '.json_encode("../delete/submit.php$itemQuery")
        .'</script>'
        .'<script type="text/javascript" src="index.js?2"></script>',
]);
