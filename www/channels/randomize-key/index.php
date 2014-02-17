<?php

include_once '../fns/require_channel.php';
include_once '../../lib/mysqli.php';
list($channel, $id) = require_channel($mysqli);

include_once '../../fns/create_tabs.php';
include_once '../../lib/page.php';

unset($_SESSION['channels/view/index_messages']);

$page->base = '../../';
$page->title = 'Randomize Channel Key';
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
        Page::text('Are you sure you want to randomize channel key of "<b>'.htmlspecialchars($channel->channelname).'</b>"?')
        .Page::HR
        .Page::imageLink(
            'Yes, randomize channel key',
            "submit.php?id=$id",
            'yes'
        )
        .Page::HR
        .Page::imageLink('No, return back', "../view/?id=$id", 'no')
    )
);
