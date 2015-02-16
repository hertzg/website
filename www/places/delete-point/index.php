<?php

include_once '../fns/require_point.php';
include_once '../../lib/mysqli.php';
list($point, $id, $user, $place) = require_point($mysqli);

$base = '../../';
$fnsDir = '../../fns';

unset($_SESSION['places/view/messages']);

include_once '../fns/ViewPage/create.php';
include_once "$fnsDir/ItemList/escapedItemQuery.php";
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    ViewPage\create($mysqli, $place)
    .Page\confirmDialog(
        'Are you sure you want to remove the point from the place?',
        'Yes, remove point', 'submit.php'.ItemList\escapedItemQuery($id),
        '../view/'.ItemList\escapedItemQuery($place->id));

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, "Remove Point #$id?", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
