<?php

include_once 'lib/require-channel.php';
include_once '../fns/create_panel.php';
include_once '../classes/Channels.php';
include_once '../classes/Form.php';
include_once '../classes/Notifications.php';
include_once '../classes/Tab.php';
include_once '../lib/page.php';

Channels::addNumNotifications($idusers, $id, -$channel->numnotifications);

if (array_key_exists('channels/view_messages', $_SESSION)) {
    $pageMessages = Page::messages($_SESSION['channels/view_messages']);
} else {
    $pageMessages = '';
}

unset($_SESSION['channels/index_messages']);

$page->base = '../';
$page->title = htmlspecialchars($channel->channelname);
$page->finish(
    Tab::create(
        Tab::item('Notifications', '../notifications.php')
        .Tab::item('Channels', './')
        .Tab::activeItem('View'),
        $pageMessages
        .Form::label('Channel name', htmlspecialchars($channel->channelname))
        .Page::HR
        .Form::textfield('channelkey', 'Channel key', array(
            'readonly' => true,
            'value' => bin2hex($channel->channelkey),
        ))
    )
    .create_panel(
        'Options',
        Page::imageLink(
            'Randomize Channel Key',
            "randomize-key.php?id=$id",
            'randomize'
        )
        .Page::HR
        .Page::imageLink('Delete Channel', "delete.php?id=$id", 'trash-bin')
    )
);
