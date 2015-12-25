<?php

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

$items = [];

if ($user->num_channels) {

    include_once "$fnsDir/Channels/indexOnUser.php";
    include_once '../../lib/mysqli.php';
    $channels = Channels\indexOnUser($mysqli, $user->id_users);

    include_once "$fnsDir/Page/imageArrowLink.php";
    foreach ($channels as $channel) {

        $public = $channel->public;
        if ($channel->receive_notifications) {
            if ($public) $icon = 'channel';
            else $icon = 'locked-channel';
        } else {
            if ($public) $icon = 'inactive-channel';
            else $icon = 'locked-inactive-channel';
        }

        $title = htmlspecialchars($channel->channel_name);
        $id = $channel->id;
        $options = ['id' => $id];
        $items[] = Page\imageArrowLink($title, "view/?id=$id", $icon, $options);

    }

} else {
    include_once "$fnsDir/Page/info.php";
    $items[] = Page\info('No channels');
}

include_once 'fns/unset_session_vars.php';
unset_session_vars();

include_once "$fnsDir/Page/imageLink.php";
include_once "$fnsDir/Page/newItemButton.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/sessionMessages.php";
include_once "$fnsDir/Page/tabs.php";
$content =
    Page\tabs(
        [
            [
                'title' => 'Notifications',
                'href' => '../#channels',
            ],
        ],
        'Channels',
        Page\sessionErrors('notifications/channels/errors')
        .Page\sessionMessages('notifications/channels/messages')
        .join('<div class="hr"></div>', $items),
        Page\newItemButton('new/', 'Channel', !$user->num_channels)
    );

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Channels', $content, $base);
