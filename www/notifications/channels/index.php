<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

include_once '../../fns/Channels/indexOnUser.php';
include_once '../../lib/mysqli.php';
$channels = Channels\indexOnUser($mysqli, $user->idusers);

$items = [];

include_once '../../fns/Page/imageArrowLink.php';

if ($channels) {
    foreach ($channels as $channel) {
        $title = htmlspecialchars($channel->channelname);
        $href = "view/?id=$channel->idchannels";
        $items[] = Page\imageArrowLink($title, $href, 'channel');
    }
} else {
    include_once '../../fns/Page/info.php';
    $items[] = Page\info('No channels');
}

include_once 'fns/unset_session_vars.php';
unset_session_vars();

include_once '../../fns/create_panel.php';
include_once '../../fns/create_tabs.php';
include_once '../../fns/Page/imageLink.php';
include_once '../../fns/Page/sessionErrors.php';
include_once '../../fns/Page/sessionMessages.php';
$content =
    create_tabs(
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
        'Channels',
        Page\sessionErrors('notifications/channels/errors')
        .Page\sessionMessages('notifications/channels/messages')
        .join('<div class="hr"></div>', $items)
    )
    .create_panel(
        'Options',
        Page\imageArrowLink('New Channel', 'new/', 'create-channel')
        .'<div class="hr"></div>'
        .Page\imageLink('Download API',
            'download-zvini-api.php', 'download')
    );

include_once '../../fns/echo_page.php';
echo_page($user, 'Channels', $content, $base);
