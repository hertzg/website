<?php

include_once '../fns/require_user.php';
require_user('../');

include_once '../lib/page.php';

include_once '../fns/Channels/indexOnUser.php';
include_once '../lib/mysqli.php';
$channels = Channels\indexOnUser($mysqli, $idusers);

$channelsHtml = '';
if ($channels) {
    foreach ($channels as $i => $channel) {
        if ($i) $channelsHtml .= Page::HR;
        $channelsHtml .= Page::imageArrowLink(
            htmlspecialchars($channel->channelname),
            "view/?id=$channel->idchannels", 'channel');
    }
} else {
    include_once '../fns/Page/info.php';
    $channelsHtml .= Page\info('No channels.');
}

unset(
    $_SESSION['channels/add_errors'],
    $_SESSION['channels/add_lastpost'],
    $_SESSION['channels/hview/index_messages'],
    $_SESSION['notifications/index_messages']
);

if (array_key_exists('channels/index_messages', $_SESSION)) {
    include_once '../fns/Page/messages.php';
    $pageMessages = Page\messages($_SESSION['channels/index_messages']);
} else {
    $pageMessages = '';
}

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
        $pageMessages.$channelsHtml
    )
    .create_panel(
        'Options',
        Page::imageArrowLink('New Channel', 'new/', 'create-channel')
        .Page::HR
        .Page::imageLink('Download API',
            'download-zvini-api.php', 'download')
    )
);
