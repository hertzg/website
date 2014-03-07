<?php

include_once '../fns/require_user.php';
require_user('../');

include_once '../fns/Page/imageArrowLink.php';
include_once '../fns/Page/imageLink.php';
include_once '../lib/page.php';

include_once '../fns/Channels/indexOnUser.php';
include_once '../lib/mysqli.php';
$channels = Channels\indexOnUser($mysqli, $idusers);

$items = array();
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
    $_SESSION['channels/add_errors'],
    $_SESSION['channels/add_lastpost'],
    $_SESSION['channels/hview/index_messages'],
    $_SESSION['notifications/index_messages']
);

include_once '../fns/Page/sessionMessages.php';
$pageMessages = Page\sessionMessages('channels/index_messages');

include_once '../fns/create_panel.php';
include_once '../fns/create_tabs.php';

$page->base = '../';
$page->title = 'Channels';
$page->finish(
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '..',
            ),
            array(
                'title' => 'Notifications',
                'href' => '../notifications/',
            ),
        ),
        'Channels',
        $pageMessages.join('<div class="hr"></div>', $items)
    )
    .create_panel(
        'Options',
        Page\imageArrowLink('New Channel', 'new/', 'create-channel')
        .'<div class="hr"></div>'
        .Page\imageLink('Download API',
            'download-zvini-api.php', 'download')
    )
);
