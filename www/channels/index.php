<?php

include_once 'lib/require-user.php';
include_once '../fns/create_panel.php';
include_once '../classes/Channels.php';
include_once '../classes/Tab.php';
include_once '../classes/Users.php';
include_once '../lib/page.php';

$channels = '';
foreach (Channels::index($idusers) as $i => $channel) {
    if ($i) $channels .= Page::HR;
    $channels .= Page::imageLink(
        htmlspecialchars($channel->channelname),
        "view/?id=$channel->idchannels",
        'channel'
    );
}
if (!$channels) {
    $channels .= Page::info('No channels.');
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
        Tab::item('Notifications', '../notifications/')
        .Tab::activeItem('Channels'),
        $pageMessages
        .$channels
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
