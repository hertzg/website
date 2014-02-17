<?php

include_once 'lib/require-user.php';
include_once '../lib/page.php';

include_once '../fns/request_strings.php';
list($id) = request_strings('id');

$id = abs((int)$id);

include_once '../fns/Channels/get.php';
include_once '../lib/mysqli.php';
$channel = Channels\get($mysqli, $idusers, $id);

if (!$channel) {
    include_once '../fns/redirect.php';
    redirect();
}

unset($_SESSION['channels/view/index_messages']);

include_once '../fns/create_tabs.php';

$page->base = '../';
$page->title = 'Randomize Channel Key';
$page->finish(
    create_tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => '../notifications/',
            ],
            [
                'title' => 'Channels',
                'href' => './',
            ],
        ],
        "Channel #$id",
        Page::text('Are you sure you want to randomize channel key of "<b>'.htmlspecialchars($channel->channelname).'</b>"?')
        .Page::HR
        .Page::imageLink(
            'Yes, randomize channel key',
            "submit-randomize-key.php?id=$id",
            'yes'
        )
        .Page::HR
        .Page::imageLink('No, return back', "view/?id=$id", 'no')
    )
);
