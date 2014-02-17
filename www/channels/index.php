<?php

include_once 'lib/require-user.php';
include_once '../lib/page.php';

include_once '../fns/Channels/index.php';
include_once '../lib/mysqli.php';
$channels = Channels\index($mysqli, $idusers);

$channelsHtml = '';
if ($channels) {
    foreach ($channels as $i => $channel) {
        if ($i) $channelsHtml .= Page::HR;
        $channelsHtml .= Page::imageLink(
            htmlspecialchars($channel->channelname),
            "view/?id=$channel->idchannels",
            'channel'
        );
    }
} else {
    $channelsHtml .= Page::info('No channels.');
}

unset(
    $_SESSION['channels/add_errors'],
    $_SESSION['channels/add_lastpost'],
    $_SESSION['channels/view/index_messages'],
    $_SESSION['notifications/index_messages']
);

if (array_key_exists('channels/index_messages', $_SESSION)) {
    $pageMessages = Page::messages($_SESSION['channels/index_messages']);
} else {
    $pageMessages = '';
}

include_once '../fns/create_panel.php';
include_once '../fns/create_tabs.php';

$page->base = '../';
$page->title = 'Channels';
$page->finish(
    create_tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => '..',
            ],
            [
                'title' => 'Notifications',
                'href' => '../notifications/',
            ],
        ],
        'Channels',
        $pageMessages.$channelsHtml
    )
    .create_panel(
        'Options',
        Page::imageLink('New Channel', 'new/', 'create-channel')
        .Page::HR
        .Page::imageLink(
            'Download API',
            'download-zvini-api.php',
            'download'
        )
    )
);
