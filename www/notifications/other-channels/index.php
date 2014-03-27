<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

$items = [];

include_once '../../fns/ChannelUsers/indexOnSubscribedUser.php';
include_once '../../lib/mysqli.php';
$channelUsers = ChannelUsers\indexOnSubscribedUser($mysqli, $user->idusers);

include_once '../../fns/Page/imageArrowLink.php';

if ($channelUsers) {
    foreach ($channelUsers as $channelUser) {
        $items[] = Page\imageArrowLink('a', 'b', 'c');
    }
} else {
    include_once '../../fns/Page/info.php';
    $items[] = Page\info('No channels');
}

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
);

include_once '../../fns/echo_page.php';
echo_page($user, 'Other Channels', $content, $base);
