<?php

include_once '../fns/require_channel_user.php';
include_once '../../../lib/mysqli.php';
list($channel_user, $id, $user) = require_channel_user($mysqli, '../..');

$id_channels = $channel_user->id_channels;

include_once '../../../fns/create_tabs.php';
include_once '../../../fns/Form/label.php';
include_once '../../../fns/Page/sessionMessages.php';
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
    Page\sessionMessages('channels/users/view/messages')
    .Form\label('Username', htmlspecialchars($channel_user->username))
);

include_once '../../../fns/echo_page.php';
echo_page($user, "Channel User #$id", $content, '../../../');
