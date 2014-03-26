<?php

include_once '../fns/require_channel.php';
include_once '../../lib/mysqli.php';
list($channel, $id, $user) = require_channel($mysqli);

unset(
    $_SESSION['channels/users/add/errors'],
    $_SESSION['channels/users/add/values'],
    $_SESSION['channels/view/messages']
);

$items = [];

include_once '../../fns/Page/imageArrowLink.php';

include_once '../../fns/ChannelUsers/indexOnChannel.php';
$channelUsers = ChannelUsers\indexOnChannel($mysqli, $id);

if ($channelUsers) {
    foreach ($channelUsers as $channelUser) {
        $username = htmlspecialchars($channelUser->username);
        $href = "view/?id=$channelUser->id";
        $items[] = Page\imageArrowLink($username, $href, 'TODO');
    }
} else {
    include_once '../../fns/Page/info.php';
    $items[] = Page\info('No users');
}

$options = [];

$options[] = Page\imageArrowLink('Add User', "add/?id=$id", 'TODO');

include_once '../../fns/create_panel.php';
include_once '../../fns/create_tabs.php';
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
    join('<div class="hr"></div>', $items)
    .create_panel('Options', join('<div class="hr"></div>', $options))
);

include_once '../../fns/echo_page.php';
echo_page($user, "Channel #$id Users", $content, '../../');
