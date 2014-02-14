<?php

include_once 'lib/require-user.php';
include_once '../fns/create_panel.php';
include_once '../classes/Tab.php';
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

$page->base = '../';
$page->title = 'Channels';
$page->finish(
    Tab::create(
        Tab::item('&middot;&middot;&middot;', '..')
        .Tab::item('Notifications', '../notifications/')
        .Tab::activeItem('Channels'),
        $pageMessages
        .$channelsHtml
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
