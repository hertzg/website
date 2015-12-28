<?php

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

unset(
    $_SESSION['notifications/messages'],
    $_SESSION['notifications/subscribed-channels/subscribe/errors'],
    $_SESSION['notifications/subscribed-channels/subscribe/values'],
    $_SESSION['notifications/subscribed-channels/view/messages']
);

$items = [];

if ($user->num_subscribed_channels) {

    include_once "$fnsDir/SubscribedChannels/indexOnSubscriber.php";
    include_once '../../lib/mysqli.php';
    $subscribedChannels = SubscribedChannels\indexOnSubscriber(
        $mysqli, $user->id_users);

    include_once "$fnsDir/Page/imageArrowLink.php";
    foreach ($subscribedChannels as $subscribedChannel) {

        if ($subscribedChannel->receive_notifications) {
            $icon = 'subscribed-channel';
        } else {
            $icon = 'inactive-subscribed-channel';
        }

        $title = htmlspecialchars($subscribedChannel->channel_name);
        $id = $subscribedChannel->id;
        $items[] = Page\imageArrowLink($title,
            "view/?id=$id", $icon, ['id' => $id]);

    }

} else {
    include_once "$fnsDir/Page/info.php";
    $items[] = Page\info('No channels');
}

include_once 'fns/create_options_panel.php';
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionMessages.php";
$content = Page\create(
    [
        'title' => 'Notifications',
        'href' => '../#subscribed-channels',
    ],
    'Other Channels',
    Page\sessionMessages('notifications/subscribed-channels/messages')
    .join('<div class="hr"></div>', $items)
    .create_options_panel()
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Other Channels', $content, $base);
