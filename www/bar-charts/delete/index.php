<?php

include_once '../fns/require_bar_chart.php';
include_once '../../lib/mysqli.php';
list($bar_chart, $id, $user) = require_bar_chart($mysqli);

unset($_SESSION['bar-charts/view/messages']);

$base = '../../';
$fnsDir = '../../fns';

include_once '../fns/ViewPage/create.php';
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    ViewPage\create($mysqli, $user, $bar_chart, $scripts)
    .Page\confirmDialog('Are you sure you want to delete the bar chart?'
        .' It will be moved to Trash.', 'Yes, delete bar chart',
        "submit.php?id=$id", "../view/?id=$id");

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, "Delete Bar Chart #$id?", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts,
]);
