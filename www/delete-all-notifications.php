<?php

include_once 'lib/require-user.php';
include_once 'classes/Page.php';
include_once 'classes/Tab.php';

unset($_SESSION['notifications_messages']);

$page->title = 'Clear Notifications';
$page->finish(
    Tab::create(
        Tab::activeItem('Notifications'),
        Page::text('Are you sure you want to delete all notifications?')
        .Page::HR
        .Page::imageLink('Yes, delete all notifications', 'submit-delete-all-notifications.php', 'yes')
        .Page::HR
        .Page::imageLink('No, return back', 'notifications.php', 'no')
    )
);
