<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_bar.php';
include_once '../../lib/mysqli.php';
list($bar, $id, $user) = require_bar($mysqli);

unset($_SESSION['bar-charts/view-bar/messages']);

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/ItemList/escapedItemQuery.php";
$escapedItemQuery = ItemList\escapedItemQuery($id);

include_once '../fns/ViewBarPage/create.php';
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    ViewBarPage\create($bar, $scripts)
    .Page\confirmDialog('Are you sure you want to delete the bar?',
        'Yes, delete bar', "submit.php$escapedItemQuery",
        "../view-bar/$escapedItemQuery");

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Delete Bar #$id?", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts,
]);
