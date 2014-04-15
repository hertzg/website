<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

unset($_SESSION['notifications/subscribed-channels/view/messages']);

$items = [];

include_once '../../fns/SubscribedChannels/indexOnSubscriber.php';
include_once '../../lib/mysqli.php';
$subscribedChannels = SubscribedChannels\indexOnSubscriber(
    $mysqli, $user->id_users);

include_once '../../fns/Page/imageArrowLink.php';

if ($subscribedChannels) {
    foreach ($subscribedChannels as $subscribedChannel) {

        if ($subscribedChannel->receive_notifications) {
            $icon = 'subscribed-channel';
        } else {
            $icon = 'inactive-subscribed-channel';
        }

        $title = htmlspecialchars($subscribedChannel->channel_name);
        $href = "view/?id=$subscribedChannel->id";
        $items[] = Page\imageArrowLink($title, $href, $icon);

    }
} else {
    include_once '../../fns/Page/info.php';
    $items[] = Page\info('No channels');
}

include_once '../../fns/create_panel.php';
include_once '../../fns/create_tabs.php';
$content = create_tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../../home/',
        ],
        [
            'title' => 'Notifications',
            'href' => '..',
        ],
    ],
    'Other Channels',
    join('<div class="hr"></div>', $items)
    .create_panel('Options', Page\imageArrowLink('Subscribe to a Public Channel', 'subscribe/', 'TODO'))
);

include_once '../../fns/echo_page.php';
echo_page($user, 'Other Channels', $content, $base);
