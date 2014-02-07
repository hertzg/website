<?php

include_once 'lib/require-user.php';
include_once '../../fns/request_strings.php';
include_once '../../classes/Channels.php';
include_once '../../classes/Tab.php';
include_once '../../lib/page.php';

list($id) = request_strings('id');

$id = abs((int)$id);

$channel = Channels::get($idusers, $id);
if (!$channel) {
    include_once '../../fns/redirect.php';
    redirect('..');
}

unset($_SESSION['notifications/index_messages']);

$page->base = '../../';
$page->title = 'Delete Notifications?';
$page->finish(
    Tab::create(
        Tab::item('Home', '../..')
        .Tab::activeItem('Notifications'),
        Page::text(
            'Are you sure you want to delete notifications in this channel?'
        )
        .Page::HR
        .Page::imageLink(
            'Yes, delete notifications',
            "submit.php?id=$id",
            'yes'
        )
        .Page::HR
        .Page::imageLink('No, return back', "../?id=$id", 'no')
    )
);
