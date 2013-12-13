<?php

include_once 'lib/require-user.php';
include_once '../fns/redirect.php';
include_once '../fns/request_strings.php';
include_once '../classes/Channels.php';
include_once '../classes/Page.php';
include_once '../classes/Tab.php';

list($id) = request_strings('id');

$channel = Channels::get($idusers, $id);
if (!$channel) redirect();

unset($_SESSION['channels/view_messages']);

$page->base = '../';
$page->title = 'Randomize Channel Key';
$page->finish(
    Tab::create(
        Tab::item('Notifications', '../notifications.php')
        .Tab::item('Channels', 'index.php')
        .Tab::activeItem('View')
    )
    .Page::text('Are you sure you want to randomize channel key of "<b>'.htmlspecialchars($channel->channelname).'</b>"?')
    .Page::HR
    .Page::imageLink('Yes, randomize channel key', "submit-randomize-key.php?id=$id", 'yes')
    .Page::HR
    .Page::imageLink('No, return back', "view.php?id=$id", 'no')
);
