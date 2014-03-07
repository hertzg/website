<?php

include_once 'fns/require_channel.php';
include_once '../../../lib/mysqli.php';
list($channel, $id) = require_channel($mysqli);

unset($_SESSION['notifications/in-channel/index_messages']);

include_once '../../../fns/Page/text.php';
$question = Page\text(
    'Are you sure you want to delete notifications in this channel?'
);

include_once '../../../fns/create_tabs.php';
include_once '../../../lib/page.php';

$page->base = '../../../';
$page->title = 'Delete Notifications?';
$page->finish(
    create_tabs(
        array(
            array(
                'title' => 'Home',
                'href' => '../../..',
            ),
        ),
        'Notifications',
        $question.'<div class="hr"></div>'
        .Page::imageLink('Yes, delete notifications',
            "submit.php?id=$id", 'yes')
        .'<div class="hr"></div>'
        .Page::imageLink('No, return back', "../?id=$id", 'no')
    )
);
