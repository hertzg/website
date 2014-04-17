<?php

include_once '../fns/require_channel.php';
include_once '../../../lib/mysqli.php';
list($channel, $id, $user) = require_channel($mysqli);

unset(
    $_SESSION['notifications/channels/users/add/errors'],
    $_SESSION['notifications/channels/users/add/values'],
    $_SESSION['notifications/channels/users/view/messages'],
    $_SESSION['notifications/channels/view/messages']
);

$items = [];

include_once '../../../fns/Page/imageArrowLink.php';

include_once '../../../fns/SubscribedChannels/indexOnChannel.php';
$subscribedChannels = SubscribedChannels\indexOnChannel($mysqli, $id);

if ($subscribedChannels) {
    foreach ($subscribedChannels as $subscribedChannel) {

        if ($subscribedChannel->subscriber_locked) $icon = 'user';
        else $icon = 'locked-user';

        $title = htmlspecialchars($subscribedChannel->subscriber_username);
        $href = "view/?id=$subscribedChannel->id";
        $items[] = Page\imageArrowLink($title, $href, $icon);

    }
} else {
    include_once '../../../fns/Page/info.php';
    $items[] = Page\info('No users');
}

$options = [Page\imageArrowLink('Add User', "add/?id=$id", 'add-user')];

include_once '../../../fns/create_panel.php';
include_once '../../../fns/create_tabs.php';
include_once '../../../fns/Page/sessionMessages.php';
$content = create_tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '..',
        ],
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

include_once '../../../fns/echo_page.php';
echo_page($user, "Channel #$id Users", $content, '../../../');
