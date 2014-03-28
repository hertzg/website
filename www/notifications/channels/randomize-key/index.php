<?php

include_once '../fns/require_channel.php';
include_once '../../../lib/mysqli.php';
list($channel, $id, $user) = require_channel($mysqli);

unset($_SESSION['notifications/channels/view/messages']);

include_once '../../../fns/create_tabs.php';
include_once '../../../fns/Page/imageLink.php';
include_once '../../../fns/Page/text.php';
$content =
    create_tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => '../..',
            ],
            [
                'title' => 'Channels',
                'href' => '..',
            ],
        ],
        "Channel #$id",
        Page\text(
            'Are you sure you want to randomize the channel key of '
            .'"<b>'.htmlspecialchars($channel->channelname).'</b>"?'
        )
        .'<div class="hr"></div>'
        .Page\imageLink('Yes, randomize channel key',
            "submit.php?id=$id", 'yes')
        .'<div class="hr"></div>'
        .Page\imageLink('No, return back', "../view/?id=$id", 'no')
    );

include_once '../../../fns/echo_page.php';
echo_page($user, 'Randomize Channel Key', $content, '../../../');
