<?php

include_once 'lib/require-channel.php';
include_once '../../classes/Channels.php';
include_once '../../classes/Tab.php';
include_once '../../lib/page.php';

unset($_SESSION['channels/view/index_messages']);

$page->base = '../../';
$page->title = "Delete Channel #$id?";
$page->finish(
    Tab::create(
        Tab::item('&middot;&middot;&middot;', '../../notifications/')
        .Tab::item('Channels', '..')
        .Tab::activeItem("Channel #$id"),
        Page::text(
            'Are you sure you want to delete the channel'
            .' "<b>'.htmlspecialchars($channel->channelname).'</b>"?'
        )
        .Page::HR
        .Page::imageLink(
            'Yes, delete channel',
            "submit.php?id=$id",
            'yes'
        )
        .Page::HR
        .Page::imageLink('No, return back', "../view/?id=$id", 'no')
    )
);
