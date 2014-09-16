<?php

include_once '../fns/require_received_bookmark.php';
include_once '../../../lib/mysqli.php';
list($receivedBookmark, $id, $user) = require_received_bookmark($mysqli);

unset($_SESSION['bookmarks/received/view/messages']);

include_once '../../../fns/Page/imageLink.php';
include_once '../../../fns/Page/tabs.php';
include_once '../../../fns/Page/text.php';
include_once '../../../fns/Page/twoColumns.php';
$content = Page\tabs(
    [
        [
            'title' => 'Received',
            'href' => '..',
        ],
    ],
    "Received Bookmark #$id",
    Page\text('Are you sure you want to delete the bookmark?'
        .' It will be moved to Trash.')
    .'<div class="hr"></div>'
    .Page\twoColumns(
        Page\imageLink('Yes, delete bookmark', "submit.php?id=$id", 'yes'),
        Page\imageLink('No, return back', "../view/?id=$id", 'no')
    )
);

include_once '../../../fns/echo_page.php';
echo_page($user, "Delete Received Bookmark #$id?", $content, '../../../');
