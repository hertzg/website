<?php

include_once '../fns/require_channel.php';
include_once '../../../lib/mysqli.php';
list($channel, $id, $user) = require_channel($mysqli);

unset(
    $_SESSION['notifications/channels/errors'],
    $_SESSION['notifications/channels/messages'],
    $_SESSION['notifications/channels/users/messages']
);

include_once 'fns/create_options_panel.php';
include_once '../../../fns/create_tabs.php';
include_once '../../../fns/Form/label.php';
include_once '../../../fns/Form/textfield.php';
include_once '../../../fns/Page/sessionMessages.php';
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
        Page\sessionMessages('notifications/channels/view/messages')
        .Form\label('Channel name', htmlspecialchars($channel->channel_name))
        .'<div class="hr"></div>'
        .Form\textfield('channel_key', 'Channel key', [
            'readonly' => true,
            'value' => bin2hex($channel->channel_key),
        ])
    )
    .create_options_panel($channel);

include_once '../../../fns/echo_page.php';
echo_page($user, "Channel #$id", $content, '../../../');
