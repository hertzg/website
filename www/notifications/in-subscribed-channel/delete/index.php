<?php

include_once '../fns/require_subscribed_channel.php';
include_once '../../../lib/mysqli.php';
list($channel, $id, $user) = require_subscribed_channel($mysqli, '../..');

unset($_SESSION['notifications/in-subscribed-channel/messages']);

include_once '../../../fns/Page/tabs.php';
include_once '../../../fns/Page/imageLink.php';
include_once '../../../fns/Page/text.php';
include_once '../../../fns/Page/twoColumns.php';
$content = Page\tabs(
    [
        [
            'title' => 'Home',
            'href' => '../../../home/',
        ],
    ],
    'Notifications',
    Page\text(
        'Are you sure you want to delete notifications in this channel?'
    )
    .'<div class="hr"></div>'
    .Page\twoColumns(
        Page\imageLink('Yes, delete notifications', "submit.php?id=$id", 'yes'),
        Page\imageLink('No, return back', "../?id=$id", 'no')
    )
);

include_once '../../../fns/echo_page.php';
echo_page($user, 'Delete Notifications?', $content, '../../../');
