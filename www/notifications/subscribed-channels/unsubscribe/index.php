<?php

include_once '../fns/require_public_subscribed_channel.php';
include_once '../../../lib/mysqli.php';
list($subscribed_channel, $id, $user) = require_public_subscribed_channel($mysqli);

include_once '../../../fns/create_tabs.php';
include_once '../../../fns/Page/imageLink.php';
include_once '../../../fns/Page/text.php';
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
    Page\text('Are you sure you want to unsubscribe from the channel?')
    .'<div class="hr"></div>'
    .Page\imageLink('Yes, unsubscribe from channel', "submit.php?id=$id", 'yes')
    .'<div class="hr"></div>'
    .Page\imageLink('No, return back', "../view/?id=$id", 'no')
);

include_once '../../../fns/echo_page.php';
echo_page($user, "Unsubscribe from Other Channel #$id", $content, '../../../');
