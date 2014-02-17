<?php

include_once 'lib/require-channel.php';
include_once '../../fns/create_tabs.php';
include_once '../../lib/page.php';

unset($_SESSION['channels/view/index_messages']);

$page->base = '../../';
$page->title = "Delete Channel #$id?";
$page->finish(
    create_tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => '../../notifications/',
            ],
            [
                'title' => 'Channels',
                'href' => '..',
            ],
        ],
        "Channel #$id",
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
