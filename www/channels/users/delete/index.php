<?php

include_once '../fns/require_subscribed_channel.php';
include_once '../../../lib/mysqli.php';
list($subscribed_channel, $id, $user) = require_subscribed_channel($mysqli);

$id_channels = $subscribed_channel->id_channels;

include_once '../../../fns/create_tabs.php';
include_once '../../../fns/Page/imageLink.php';
include_once '../../../fns/Page/text.php';
$content = create_tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => "../../view/?id=$id_channels",
        ],
        [
            'title' => 'Users',
            'href' => "../?id=$id_channels",
        ],
    ],
    "User #$id",
    Page\text(
        'Are you sure you want to remove the user "<b>'
        .htmlspecialchars($subscribed_channel->subscribed_username)
        .'</b>" from the channel "<b>'
        .htmlspecialchars($subscribed_channel->channel_name)
        .'</b>"?'
    )
    .'<div class="hr"></div>'
    .Page\imageLink('Yes, remove user', "submit.php?id=$id", 'yes')
    .'<div class="hr"></div>'
    .Page\imageLink('No, return back', "../view/?id=$id", 'no')
);

include_once '../../../fns/echo_page.php';
echo_page($user, "Remove Channel User #$id", $content, '../../../');
