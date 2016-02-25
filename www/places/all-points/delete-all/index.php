<?php

include_once '../../../../lib/defaults.php';

include_once '../fns/require_points.php';
include_once '../../../lib/mysqli.php';
list($place, $id, $user) = require_points($mysqli, '../');

$base = '../../../';
$fnsDir = '../../../fns';

unset($_SESSION['places/all-points/messages']);

include_once '../fns/create_page.php';
include_once "$fnsDir/ItemList/escapedItemQuery.php";
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    create_page($mysqli, $user, $place, '../')
    .Page\confirmDialog(
        'Are you sure you want to delete all the points?',
        'Yes, delete all points', "submit.php?id=$id",
        '../'.ItemList\escapedItemQuery($id));

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Delete All Points of Place #$id?", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
