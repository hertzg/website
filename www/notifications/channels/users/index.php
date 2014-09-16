<?php

$fnsDir = '../../../fns';

include_once '../fns/require_channel.php';
include_once '../../../lib/mysqli.php';
list($channel, $id, $user) = require_channel($mysqli);

unset(
    $_SESSION['notifications/channels/users/add/errors'],
    $_SESSION['notifications/channels/users/add/values'],
    $_SESSION['notifications/channels/users/messages'],
    $_SESSION['notifications/channels/view/messages']
);

$items = [];

include_once "$fnsDir/SubscribedChannels/indexPublisherLockedOnChannel.php";
$subscribedChannels = SubscribedChannels\indexPublisherLockedOnChannel(
    $mysqli, $id);

if ($subscribedChannels) {
    include_once "$fnsDir/Page/removableItem.php";
    foreach ($subscribedChannels as $subscribedChannel) {
        $title = htmlspecialchars($subscribedChannel->subscriber_username);
        $href = "delete/?id=$subscribedChannel->id";
        $items[] = Page\removableItem($title, $href, 'user');
    }
} else {
    include_once "$fnsDir/Page/info.php";
    $items[] = Page\info('No users');
}

include_once "$fnsDir/Page/imageArrowLink.php";
$options = [Page\imageArrowLink('Add User', "add/?id=$id", 'add-user')];

include_once "$fnsDir/create_panel.php";
include_once "$fnsDir/Page/tabs.php";
include_once "$fnsDir/Page/sessionMessages.php";
$content = Page\tabs(
    [
        [
            'title' => "Channel #$id",
            'href' => "../view/?id=$id",
        ],
    ],
    'Users',
    Page\sessionMessages('notifications/channels/users/messages')
    .join('<div class="hr"></div>', $items)
    .create_panel('Options', join('<div class="hr"></div>', $options))
);

include_once "$fnsDir/echo_page.php";
echo_page($user, "Channel #$id Users", $content, '../../../');
