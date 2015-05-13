<?php

include_once '../fns/require_bars.php';
include_once '../../../lib/mysqli.php';
list($bar_chart, $id, $user) = require_bars($mysqli, '../');

$base = '../../../';
$fnsDir = '../../../fns';

unset($_SESSION['bar-charts/all-bars/messages']);

include_once '../fns/create_page.php';
include_once "$fnsDir/ItemList/escapedItemQuery.php";
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    create_page($mysqli, $user, $bar_chart, $scripts, '../')
    .Page\confirmDialog(
        'Are you sure you want to delete all the bars?',
        'Yes, delete all bars', "submit.php?id=$id",
        '../'.ItemList\escapedItemQuery($id));

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, "Delete All Bars of BarChart #$id?", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts,
]);
