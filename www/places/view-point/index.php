<?php

include_once '../fns/require_point.php';
include_once '../../lib/mysqli.php';
list($point, $id, $user, $place) = require_point($mysqli);

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/ItemList/itemQuery.php";
$itemQuery = ItemList\itemQuery($id);

include_once '../fns/create_view_point_page.php';
include_once "$fnsDir/compressed_js_script.php";
$content =
    create_view_point_page($point)
    .compressed_js_script('confirmDialog', $base)
    .'<script type="text/javascript">'
        .'var deleteHref = '.json_encode("../delete-point/submit.php$itemQuery")
    .'</script>'
    .'<script type="text/javascript" defer="defer" src="../view-place.js">'
    .'</script>';

include_once "$fnsDir/echo_page.php";
echo_page($user, "Point #$id", $content, $base);
