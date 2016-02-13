<?php

include_once '../fns/require_bar_chart.php';
include_once '../../lib/mysqli.php';
list($bar_chart, $id, $user) = require_bar_chart($mysqli);

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/ItemList/itemQuery.php";
$itemQuery = ItemList\itemQuery($id);

include_once '../fns/ViewPage/create.php';
include_once "$fnsDir/compressed_js_script.php";
$content =
    ViewPage\create($mysqli, $user, $bar_chart, $scripts, $head)
    .compressed_js_script('confirmDialog', $base)
    .'<script type="text/javascript">'
        .'var deleteHref = '.json_encode("../delete/submit.php$itemQuery")
    .'</script>'
    .'<script type="text/javascript" src="index.js?1"></script>';

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Bar Chart #$id", $content, $base, [
    'head' => $head.compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts,
]);
