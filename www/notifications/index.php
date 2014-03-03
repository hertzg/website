<?php

include_once '../fns/require_user.php';
require_user('../');

include_once '../lib/page.php';

include_once '../fns/request_strings.php';
list($id) = request_strings('id');

$id = abs((int)$id);

include_once '../fns/Users/clearNumNewNotifications.php';
include_once '../lib/mysqli.php';
Users\clearNumNewNotifications($mysqli, $idusers);

$options = array();

$num_channels = $user->num_channels;

if ($num_channels) {
    $options[] = Page::imageArrowLinkWithDescription('Channels',
        "$num_channels total.", '../channels/', 'channels');
} else {
    $options[] = Page::imageArrowLink('Channels', '../channels/', 'channels');
}

$filterMessage = '';
$notificationsHtml = '';

$num_new_notifications = $user->num_new_notifications;

include_once '../fns/Channels/get.php';
$channel = Channels\get($mysqli, $idusers, $id);

if ($channel) {
    $filterMessage =
        '<div class="filterBar">'
            .'Channel: <b>'.htmlspecialchars($channel->channelname).'</b>'
            .'<a class="clickable" title="Clear Filter" href="./">'
                .'<span class="icon no"></span>'
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
        $options[] = Page::imageArrowLink('Delete Notifications',
            "delete/?id=$id", 'trash-bin');
    } else {
        $options[] = Page::imageArrowLink('Delete All Notifications',
            'delete-all/', 'trash-bin');
    }

    include_once '../fns/create_image_text.php';

    foreach ($notifications as $i => $notification) {
        if ($i) $notificationsHtml .= Page::HR;
        $iconName = $i < $num_new_notifications ? 'notification' : 'old-notification';
        $itemHtml = '';
        if (!$channel) {
            $itemHtml =
                "<a class=\"a\" href=\"./?id=$notification->idchannels\">"
                    .$notification->channelname
                .'</a>: ';
        }
        $content =
            $itemHtml
            .nl2br(
                preg_replace(
                    '#(http://.*?)(\s|$)#',
                    '<a class="a" rel="noreferrer" href="$1">$1</a>$2',
                    htmlspecialchars($notification->notificationtext)
                )
            );
        $notificationsHtml .= create_image_text($content, $iconName);
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
        array(
            array(
                'title' => 'Home',
                'href' => '..',
            ),
        ),
        'Notifications',
        $pageMessages
        .$filterMessage
        .$notificationsHtml
        .create_panel('Options', join(Page::HR, $options))
    )
);
