<?php

include_once 'fns/require_channel.php';
include_once '../../lib/mysqli.php';
list($channel, $id) = require_channel($mysqli);

unset($_SESSION['notifications/index_messages']);

include_once '../../fns/create_tabs.php';
include_once '../../lib/page.php';

$page->base = '../../';
$page->title = 'Delete Notifications?';
$page->finish(
    create_tabs(
        array(
            array(
                'title' => 'Home',
                'href' => '../..',
            ),
        ),
        'Notifications',
        Page::text(
            'Are you sure you want to delete notifications in this channel?'
        )
        .Page::HR
        .Page::imageLink('Yes, delete notifications',
            "submit.php?id=$id", 'yes')
        .Page::HR
        .Page::imageLink('No, return back', "../?id=$id", 'no')
    )
);
