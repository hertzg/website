<?php

include_once '../fns/require_channel_user.php';
include_once '../../../lib/mysqli.php';
list($channel_user, $id, $user) = require_channel_user($mysqli);

$id_channels = $channel_user->id_channels;

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
        .htmlspecialchars($channel_user->username)
        .'</b>" from this channel?'
    )
    .'<div class="hr"></div>'
    .Page\imageLink('Yes, remove user', "submit.php?id=$id", 'yes')
    .'<div class="hr"></div>'
    .Page\imageLink('No, return back', "../view/?id=$id", 'no')
);

include_once '../../../fns/echo_page.php';
echo_page($user, "Remove Channel User #$id", $content, '../../../');
