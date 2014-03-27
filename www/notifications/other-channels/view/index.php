<?php

include_once 'fns/require_other_channel.php';
include_once '../../../lib/mysqli.php';
list($channel_user, $id, $user) = require_other_channel($mysqli);

include_once '../../../fns/create_tabs.php';
$content = create_tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../..',
        ],
        [
            'title' => 'Other Channels',
            'href' => '..',
        ],
    ],
    "Other Channel #$id",
    'asd'
);

include_once '../../../fns/echo_page.php';
echo_page($user, "Other Channel #$id", $content, '../../../');
