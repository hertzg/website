<?php

include_once '../fns/require_received_files.php';
$user = require_received_files('../');

unset($_SESSION['files/received/messages']);

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
            'title' => 'Files',
            'href' => '../..',
        ],
    ],
    'Received',
    Page\text('Are you sure you want to delete all the received files?')
    .'<div class="hr"></div>'
    .Page\twoColumns(
        Page\imageLink('Yes, delete all files', 'submit.php', 'yes'),
        Page\imageLink('No, return back', '..', 'no')
    )
);

include_once '../../../fns/echo_page.php';
echo_page($user, 'Delete All Received Files', $content, '../../../');
