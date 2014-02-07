<?php

include_once 'lib/require-user.php';
include_once '../fns/redirect.php';
include_once '../fns/request_strings.php';
include_once '../classes/Channels.php';
include_once '../classes/Tab.php';
include_once '../lib/page.php';

list($id) = request_strings('id');

$id = abs((int)$id);
$channel = Channels::get($idusers, $id);
if (!$channel) redirect();

unset($_SESSION['channels/view/index_messages']);

$page->base = '../';
$page->title = 'Randomize Channel Key';
$page->finish(
    Tab::create(
        Tab::item('&middot;&middot;&middot;', '../notifications/')
        .Tab::item('Channels', './')
        .Tab::activeItem("Channel #$id"),
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
