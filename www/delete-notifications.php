<?php

include_once 'lib/require-user.php';
include_once 'fns/redirect.php';
include_once 'fns/request_strings.php';
include_once 'classes/Channels.php';
include_once 'classes/Page.php';
include_once 'classes/Tab.php';

list($id) = request_strings('id');

$channel = Channels::get($idusers, $id);
if (!$channel) redirect('notifications.php');

unset($_SESSION['notifications_messages']);

$page->title = 'Clear Notifications';
$page->finish(
    Tab::create(
        Tab::item('Home', 'home.php')
        .Tab::activeItem('Notifications')
    )
    .Page::text('Are you sure you want to delete notifications in this channel?')
    .Page::HR
    .Page::imageLink('Yes, delete notifications', "submit-delete-notifications.php?id=$id", 'yes')
    .Page::HR
    .Page::imageLink('No, return back', "notifications.php?id=$id", 'no')
);
