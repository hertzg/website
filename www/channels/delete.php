<?php

include_once 'lib/require-channel.php';
include_once '../classes/Channels.php';
include_once '../classes/Tab.php';
include_once '../lib/page.php';

unset($_SESSION['channels/view_messages']);

$page->base = '../';
$page->title = 'Delete Channel?';
$page->finish(
    Tab::create(
        Tab::item('Notifications', '../notifications.php')
        .Tab::item('Channels', './')
        .Tab::activeItem('View'),
        Page::text(
            'Are you sure you want to delete the channel'
            .' "<b>'.htmlspecialchars($channel->channelname).'</b>"?'
        )
        .Page::HR
        .Page::imageLink(
            'Yes, delete channel',
            "submit-delete.php?id=$id",
            'yes'
        )
        .Page::HR
        .Page::imageLink('No, return back', "view.php?id=$id", 'no')
    )
);
