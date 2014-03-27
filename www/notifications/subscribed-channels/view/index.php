<?php

include_once 'fns/require_subscribed_channel.php';
include_once '../../../lib/mysqli.php';
list($subscribed_channel, $id, $user) = require_subscribed_channel($mysqli);

include_once 'fns/create_options_panel.php';
include_once '../../../fns/create_tabs.php';
include_once '../../../fns/Form/label.php';
include_once '../../../fns/Page/sessionMessages.php';
$content =
    create_tabs(
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
        Page\sessionMessages('notifications/subscribed-channels/view/messages')
        .Form\label('Channel name', htmlspecialchars($subscribed_channel->channel_name))
        .'<div class="hr"></div>'
        .Form\label('Channel owner', htmlspecialchars($subscribed_channel->username))
    )
    .create_options_panel($subscribed_channel);

include_once '../../../fns/echo_page.php';
echo_page($user, "Other Channel #$id", $content, '../../../');
