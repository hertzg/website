<?php

include_once '../fns/require_user.php';
require_user('../');

include_once '../lib/page.php';

include_once '../fns/request_strings.php';
list($id) = request_strings('id');

$id = abs((int)$id);

include_once '../fns/Users/clearNumNotifications.php';
include_once '../lib/mysqli.php';
Users\clearNumNotifications($mysqli, $idusers);

$options = array();

include_once '../fns/Channels/countOnUser.php';
$numChannels = Channels\countOnUser($mysqli, $idusers);

if ($numChannels) {
    $options[] = Page::imageLinkWithDescription('Channels', "$numChannels total.", '../channels/', 'channels');
} else {
    $options[] = Page::imageLink('Channels', '../channels/', 'channels');
}

$filterMessage = '';
$notificationsHtml = '';

$numNotifications = $user->numnotifications;

include_once '../fns/Channels/get.php';
$channel = Channels\get($mysqli, $idusers, $id);

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
    include_once '../fns/Notifications/indexOnUserChannel.php';
    $notifications = Notifications\indexOnUserChannel($mysqli, $idusers, $id);
} else {
    include_once '../fns/Notifications/indexOnUser.php';
    $notifications = Notifications\indexOnUser($mysqli, $idusers);
}

if ($notifications) {

    if ($channel) {
        $options[] = Page::imageLink(
            'Delete Notifications',
            "delete/?id=$id",
            'trash-bin'
        );
    } else {
        $options[] = Page::imageLink(
            'Delete All Notifications',
            'delete-all/',
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
            $itemHtml
            .nl2br(
                preg_replace(
                    '#(http://.*?)(\s|$)#',
                    '<a class="a" rel="noreferrer" href="$1">$1</a>$2',
                    htmlspecialchars($notification->notificationtext)
                )
            ),
            $iconName
        );
    }
} else {
    $notificationsHtml = Page::info('No notifications.');
}

unset(
    $_SESSION['channels/index_messages'],
    $_SESSION['home/index_messages']
);

if (array_key_exists('notifications/index_messages', $_SESSION)) {
    $pageMessages = Page::messages($_SESSION['notifications/index_messages']);
} else {
    $pageMessages = '';
}

include_once '../fns/create_panel.php';
include_once '../fns/create_tabs.php';

$page->base = '../';
$page->title = 'Notifications';
$page->finish(
    create_tabs(
        [
            [
                'title' => 'Home',
                'href' => '..',
            ],
        ],
        'Notifications',
        $pageMessages
        .$filterMessage
        .$notificationsHtml
        .create_panel('Options', join(Page::HR, $options))
    )
);
