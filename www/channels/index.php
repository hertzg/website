<?php

$base = '../';

include_once '../fns/require_user.php';
$user = require_user($base);

include_once '../fns/Channels/indexOnUser.php';
include_once '../lib/mysqli.php';
$channels = Channels\indexOnUser($mysqli, $user->idusers);

$items = array();

include_once '../fns/Page/imageArrowLink.php';

if ($channels) {
    foreach ($channels as $channel) {
        $items[] = Page\imageArrowLink(
            htmlspecialchars($channel->channelname),
            "view/?id=$channel->idchannels", 'channel');
    }
} else {
    include_once '../fns/Page/info.php';
    $items[] = Page\info('No channels.');
}

unset(
    $_SESSION['channels/add/index_errors'],
    $_SESSION['channels/add/index_lastpost'],
    $_SESSION['channels/hview/index_messages'],
    $_SESSION['notifications/index_messages']
);

include_once '../fns/create_panel.php';
include_once '../fns/create_tabs.php';
include_once '../fns/Page/imageLink.php';
include_once '../fns/Page/sessionErrors.php';
include_once '../fns/Page/sessionMessages.php';
$content =
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '../home/',
            ),
            array(
                'title' => 'Notifications',
                'href' => '../notifications/',
            ),
        ),
        'Channels',
        Page\sessionErrors('channels/index_errors')
        .Page\sessionMessages('channels/index_messages')
        .join('<div class="hr"></div>', $items)
    )
    .create_panel(
        'Options',
        Page\imageArrowLink('New Channel', 'new/', 'create-channel')
        .'<div class="hr"></div>'
        .Page\imageLink('Download API',
            'download-zvini-api.php', 'download')
    );

include_once '../fns/echo_page.php';
echo_page($user, 'Channels', $content, $base);
