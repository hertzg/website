<?php

include_once '../fns/require_subscribed_channel.php';
include_once '../../../lib/mysqli.php';
list($subscribedChannel, $id, $user) = require_subscribed_channel($mysqli);

unset($_SESSION['notifications/subscribed-channels/messages']);

$items = [];

include_once '../../../fns/Form/label.php';
$value = htmlspecialchars($subscribedChannel->channel_name);
$items[] = Form\label('Channel name', $value);

$publisher_locked = $subscribedChannel->publisher_locked;
if ($publisher_locked) {
    $value = htmlspecialchars($subscribedChannel->publisher_username);
    $items[] = Form\label('Channel owner', $value);
}

include_once '../../../fns/Page/text.php';
$items[] = Page\text(
    '<div>'
        .($subscribedChannel->channel_public ? 'Public' : 'Private').' channel.'
    .'</div>'
    .'<div>'
        .'You are '.($subscribedChannel->receive_notifications ? '' : 'not ')
        .' receiving notifications from this channel.'
    .'</div>'
);

include_once 'fns/create_options_panel.php';
include_once '../../../fns/create_tabs.php';
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
        .join('<div class="hr"></div>', $items)
    )
    .create_options_panel($subscribedChannel);

include_once '../../../fns/echo_page.php';
echo_page($user, "Other Channel #$id", $content, '../../../');
