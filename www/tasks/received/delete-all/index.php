<?php

include_once '../fns/require_received_tasks.php';
$user = require_received_tasks('../');

unset($_SESSION['tasks/received/messages']);

include_once '../../../fns/Page/tabs.php';
include_once '../../../fns/Page/imageLink.php';
include_once '../../../fns/Page/text.php';
include_once '../../../fns/Page/twoColumns.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../../../home/',
        ],
        [
            'title' => 'Tasks',
            'href' => '../..',
        ],
    ],
    'Received',
    Page\text('Are you sure you want to delete all the received tasks?'
        .' They will be moved to Trash.')
    .'<div class="hr"></div>'
    .Page\twoColumns(
        Page\imageLink('Yes, delete all tasks', 'submit.php', 'yes'),
        Page\imageLink('No, return back', '..', 'no')
    )
);

include_once '../../../fns/echo_page.php';
echo_page($user, 'Delete All Received Tasks?', $content, '../../../');
