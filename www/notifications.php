<?php

include_once 'lib/require-user.php';
include_once 'fns/create_panel.php';
include_once 'fns/ifset.php';
include_once 'fns/request_strings.php';
include_once 'classes/Notifications.php';
include_once 'classes/Page.php';
include_once 'classes/Tab.php';

list($id) = request_strings('id');

$id = abs((int)$id);
Users::clearNumNotifications($idusers);

$filterMessage = '';
$notificationsHtml = '';
$deleteAllLink = '';

$numNotifications = $user->numnotifications;

$channel = Channels::get($idusers, $id);
if ($channel) {
    $filterMessage =
        '<div style="position: relative; height: 48px; background: #eee; color: #444; padding: 16px">'
            .'Channel: <b>'.htmlspecialchars($channel->channelname).'</b>'
            .'<a class="clickable" title="Clear Filter" href="notifications.php"'
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

    $deleteAllLink = Page::HR;
    if ($channel) {
        $deleteAllLink .= Page::imageLink(
            'Delete Notifications',
            "delete-notifications.php?id=$id",
            'trash-bin'
        );
    } else {
        $deleteAllLink .= Page::imageLink(
            'Delete All Notifications',
            'delete-all-notifications.php',
            'trash-bin'
        );
    }

    foreach ($notifications as $i => $notification) {
        if ($i) $notificationsHtml .= Page::HR;
        $iconName = $i < $numNotifications ? 'notification' : 'old-notification';
        $itemHtml = '';
        if (!$channel) {
            $itemHtml =
                "<a class=\"a\" href=\"notifications.php?id=$notification->idchannels\">"
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

$numChannels = Channels::countOnUser($idusers);

$page->title = 'Notifications';
$page->finish(
    Tab::create(
        Tab::activeItem('Notifications'),
        Page::messages(ifset($_SESSION['notifications_messages']))
        .$filterMessage
        .$notificationsHtml
        .create_panel(
            'Options',
            ($numChannels ? Page::imageLinkWithDescription('Channels', "$numChannels total.", 'channels/', 'channels') : Page::imageLink('Channels', 'channels/', 'channels'))
            .$deleteAllLink
        )
    )
);
