<?php

include_once '../fns/require_channel.php';
include_once '../../lib/mysqli.php';
list($channel, $id) = require_channel($mysqli);

unset($_SESSION['channels/view/index_messages']);

include_once '../../fns/Page/text.php';
$question = Page\text(
    'Are you sure you want to randomize the channel key of '
    .'"<b>'.htmlspecialchars($channel->channelname).'</b>"?'
);

include_once '../../fns/create_tabs.php';
include_once '../../lib/page.php';

$page->base = '../../';
$page->title = 'Randomize Channel Key';
$page->finish(
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '../../notifications/',
            ),
            array(
                'title' => 'Channels',
                'href' => '..',
            ),
        ),
        "Channel #$id",
        $question.Page::HR
        .Page::imageLink('Yes, randomize channel key',
            "submit.php?id=$id", 'yes')
        .Page::HR
        .Page::imageLink('No, return back', "../view/?id=$id", 'no')
    )
);
