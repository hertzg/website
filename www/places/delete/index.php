<?php

include_once '../fns/require_place.php';
include_once '../../lib/mysqli.php';
list($place, $id, $user) = require_place($mysqli);

$base = '../../';
$fnsDir = '../../fns';

unset($_SESSION['places/view/messages']);

include_once "$fnsDir/ItemList/escapedItemQuery.php";
$escapedItemQuery = ItemList\escapedItemQuery($id);

include_once '../fns/ViewPage/create.php';
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    ViewPage\create($place)
    .Page\confirmDialog('Are you sure you want to delete the place?'
        .' It will be moved to Trash.', 'Yes, delete place',
        "submit.php$escapedItemQuery", "../view/$escapedItemQuery");

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, "Delete Place #$id?", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
