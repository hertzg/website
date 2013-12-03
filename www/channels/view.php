<?php

include_once 'lib/require-channel.php';
include_once '../fns/create_panel.php';
include_once '../fns/ifset.php';
include_once '../classes/Channels.php';
include_once '../classes/Form.php';
include_once '../classes/Notifications.php';
include_once '../classes/Page.php';
include_once '../classes/Tab.php';

Channels::addNumNotifications($idusers, $id, -$channel->numnotifications);

unset($_SESSION['channels/index_messages']);

$page->base = '../';
$page->title = htmlspecialchars($channel->channelname);
$page->finish(
    Tab::create(
        Tab::item('Home', '../home.php')
        .Tab::item('Notifications', '../notifications.php')
        .Tab::item('Channels', 'index.php')
        .Tab::activeItem('View')
    )
    .Page::messages(ifset($_SESSION['channels/view_messages']))
    .Form::label('Channel name', htmlspecialchars($channel->channelname))
    .Page::HR
    .Form::label('Channel key', bin2hex($channel->channelkey))
    .create_panel(
        'Options',
        Page::imageLink('Randomize Channel Key', "randomize-key.php?id=$id", 'randomize')
        .Page::HR
        .Page::imageLink('Delete Channel', "delete.php?id=$id", 'trash-bin')
    )
);
