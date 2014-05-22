<?php

include_once '../fns/require_subscriber_locked_channel.php';
include_once '../../../lib/mysqli.php';
list($subscribedChannel, $id, $user) = require_subscriber_locked_channel($mysqli);

include_once '../../../fns/Page/imageLink.php';
include_once '../../../fns/Page/tabs.php';
include_once '../../../fns/Page/text.php';
include_once '../../../fns/Page/twoColumns.php';
$content = Page\tabs(
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
    .Page\twoColumns(
        Page\imageLink('Yes, unsubscribe', "submit.php?id=$id", 'yes'),
        Page\imageLink('No, return back', "../view/?id=$id", 'no')
    )
);

include_once '../../../fns/echo_page.php';
echo_page($user, "Unsubscribe from Other Channel #$id", $content, '../../../');
