<?php

include_once 'lib/require-user.php';
include_once '../fns/create_panel.php';
include_once '../fns/request_strings.php';
include_once '../classes/Notifications.php';
include_once '../classes/Tab.php';
include_once '../lib/page.php';

list($id) = request_strings('id');

$id = abs((int)$id);
Users::clearNumNotifications($idusers);

$options = array();

$numChannels = Channels::countOnUser($idusers);
if ($numChannels) {
    $options[] = Page::imageLinkWithDescription('Channels', "$numChannels total.", '../channels/', 'channels');
} else {
    $options[] = Page::imageLink('Channels', '../channels/', 'channels');
}

$filterMessage = '';
$notificationsHtml = '';

$numNotifications = $user->numnotifications;

$channel = Channels::get($idusers, $id);
if ($channel) {
    $filterMessage =
        '<div style="position: relative; height: 48px; background: #eee; color: #444; padding: 16px">'
            .'Channel: <b>'.htmlspecialchars($channel->channelname).'</b>'
            .'<a class="clickable" title="Clear Filter" href="./"'
            .' style="position: absolute; top: 0; right: 0; bottom: 0; width: 48px">'
                .'<span class="icon no"'
                .' style="position: absolute; top: 0; right: 0; bottom: 0; left: 0; margin: auto">'
                .'</span>'
            .'</a>'
        .'</div>'
        .'<div class="warnings-hr"></div>';
    $notifications = Notifications::indexOnChannel($idusers, $id);
} else {
    $notifications = Notifications::index($idusers);
}

if ($notifications) {

    if ($channel) {
        $options[] = Page::imageLink(
            'Delete Notifications',
            "delete.php?id=$id",
            'trash-bin'
        );
    } else {
        $options[] = Page::imageLink(
            'Delete All Notifications',
            'delete-all.php',
            'trash-bin'
        );
    }

    foreach ($notifications as $i => $notification) {
        if ($i) $notificationsHtml .= Page::HR;
        $iconName = $i < $numNotifications ? 'notification' : 'old-notification';
        $itemHtml = '';
        if (!$channel) {
            $itemHtml =
                "<a class=\"a\" href=\"./?id=$notification->idchannels\">"
                    .$notification->channelname
                .'</a>: ';
        }
        $notificationsHtml .= Page::imageText(
            $itemHtml.Notifications::textToHtml($notification->notificationtext),
            $iconName
        );
    }
} else {
    $notificationsHtml = Page::info('No notifications.');
}

unset(
    $_SESSION['channels_messages'],
    $_SESSION['home_messages']
);

if (array_key_exists('notifications/index_messages', $_SESSION)) {
    $pageMessages = Page::messages($_SESSION['notifications/index_messages']);
} else {
    $pageMessages = '';
}

$page->base = '../';
$page->title = 'Notifications';
$page->finish(
    Tab::create(
        Tab::activeItem('Notifications'),
        $pageMessages
        .$filterMessage
        .$notificationsHtml
        .create_panel('Options', join(Page::HR, $options))
    )
);
