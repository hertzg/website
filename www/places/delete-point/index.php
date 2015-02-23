<?php

include_once '../fns/require_point.php';
include_once '../../lib/mysqli.php';
list($point, $id, $user, $place) = require_point($mysqli);

$base = '../../';
$fnsDir = '../../fns';

include_once '../fns/create_view_point_page.php';
include_once "$fnsDir/ItemList/escapedItemQuery.php";
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    create_view_point_page($point)
    .Page\confirmDialog(
        'Are you sure you want to delete the point?',
        'Yes, delete point', 'submit.php'.ItemList\escapedItemQuery($id),
        '../view-point/'.ItemList\escapedItemQuery($id));

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, "Delete Point #$id?", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
