<?php

include_once '../fns/require_note.php';
include_once '../../lib/mysqli.php';
list($note, $id, $user) = require_note($mysqli);

$base = '../../';
$fnsDir = '../../fns';

unset($_SESSION['notes/view/messages']);

include_once "$fnsDir/ItemList/escapedItemQuery.php";
$escapedItemQuery = ItemList\escapedItemQuery($id);

include_once '../fns/ViewPage/create.php';
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    ViewPage\create($note)
    .Page\confirmDialog('Are you sure you want to delete the note?'
        .' It will be moved to Trash.', 'Yes, delete note',
        "submit.php$escapedItemQuery", "../view/$escapedItemQuery");

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, "Delete Note #$id?", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
