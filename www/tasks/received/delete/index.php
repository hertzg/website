<?php

include_once '../fns/require_received_task.php';
include_once '../../../lib/mysqli.php';
list($receivedTask, $id, $user) = require_received_task($mysqli);

include_once '../../../fns/Page/tabs.php';
include_once '../../../fns/Page/imageLink.php';
include_once '../../../fns/Page/text.php';
include_once '../../../fns/Page/twoColumns.php';
$content = create_tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../..',
        ],
        [
            'title' => 'Received',
            'href' => '..',
        ],
    ],
    "Received Task #$id",
    Page\text('Are you sure you want to delete the task?')
    .'<div class="hr"></div>'
    .Page\twoColumns(
        Page\imageLink('Yes, delete task', "submit.php?id=$id", 'yes'),
        Page\imageLink('No, return back', "../view/?id=$id", 'no')
    )
);

include_once '../../../fns/echo_page.php';
echo_page($user, 'Delete Received Task #?', $content, '../../../');
