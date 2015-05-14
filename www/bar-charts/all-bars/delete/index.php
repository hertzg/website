<?php

include_once '../../fns/require_bar.php';
include_once '../../../lib/mysqli.php';
list($bar, $id, $user) = require_bar($mysqli, '../');

$base = '../../../';
$fnsDir = '../../../fns';

unset(
    $_SESSION['bar-charts/all-bars/messages'],
    $_SESSION['bar-charts/all-bars/view/messages']
);

include_once "$fnsDir/ItemList/escapedItemQuery.php";
$escapedItemQuery = ItemList\escapedItemQuery($id);

include_once '../fns/create_view_page.php';
include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    create_view_page($bar, $scripts)
    .Page\confirmDialog('Are you sure you want to delete the bar?',
        'Yes, delete bar', "submit.php$escapedItemQuery",
        "../view/$escapedItemQuery");

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, "Delete Bar #$id?", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts,
]);