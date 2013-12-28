<?php

include_once 'lib/require-user.php';
include_once '../fns/create_panel.php';
include_once '../classes/Channels.php';
include_once '../classes/Page.php';
include_once '../classes/Tab.php';
include_once '../classes/Users.php';

$channels = '';
foreach (Channels::index($idusers) as $i => $channel) {
    if ($i) $channels .= Page::HR;
    $channels .= Page::imageLink(
        htmlspecialchars($channel->channelname),
        "view.php?id=$channel->idchannels",
        'channel'
    );
}
if (!$channels) {
    $channels .= Page::info('No channels.');
}

unset(
    $_SESSION['channels/add_errors'],
    $_SESSION['channels/add_lastpost'],
    $_SESSION['channels/view_messages'],
    $_SESSION['notifications_messages']
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
        Tab::item('Notifications', '../notifications.php')
        .Tab::activeItem('Channels'),
        $pageMessages
        .$channels
    )
    .create_panel(
        'Options',
        Page::imageLink('New Channel', 'add.php', 'create-channel')
        .Page::HR
        .Page::imageLink(
            'Download API',
            '../download-zvini-api.php',
            'download'
        )
    )
);
