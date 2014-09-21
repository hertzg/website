<?php

include_once '../fns/require_received_note.php';
include_once '../../../lib/mysqli.php';
list($receivedNote, $id, $user) = require_received_note($mysqli, '../');

$base = '../../../';
$fnsDir = '../../../fns';

unset($_SESSION['notes/received/view/messages']);

include_once '../fns/ViewPage/create.php';
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    ViewPage\create($receivedNote)
    .Page\confirmDialog('Are you sure you want to delete the note?'
        .' It will be moved to Trash.', 'Yes, delete note',
        "submit.php?id=$id", "../view/?id=$id");

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, "Delete Received Note #$id?", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
