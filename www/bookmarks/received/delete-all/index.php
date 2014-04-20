<?php

include_once '../fns/require_received_bookmarks.php';
$user = require_received_bookmarks('../');

unset($_SESSION['bookmarks/received/messages']);

include_once '../../../fns/Page/tabs.php';
include_once '../../../fns/Page/imageLink.php';
include_once '../../../fns/Page/text.php';
include_once '../../../fns/Page/twoColumns.php';
$content = create_tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../../../home/',
        ],
        [
            'title' => 'Bookmarks',
            'href' => '../..',
        ],
    ],
    'Received',
    Page\text('Are you sure you want to delete all the received bookmarks?')
    .'<div class="hr"></div>'
    .Page\twoColumns(
        Page\imageLink('Yes, delete all bookmarks', 'submit.php', 'yes'),
        Page\imageLink('No, return back', '..', 'no')
    )
);

include_once '../../../fns/echo_page.php';
echo_page($user, 'Delete All Received Bookmarks', $content, '../../../');
