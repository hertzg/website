<?php

include_once '../fns/require_user.php';
require_user('../');

include_once '../fns/Users/clearNumNewNotifications.php';
include_once '../lib/mysqli.php';
Users\clearNumNewNotifications($mysqli, $idusers);

include_once 'fns/create_channels_link.php';
$options = array(create_channels_link($user, '../channels/'));

$items = array();

include_once '../fns/Notifications/indexOnUser.php';
$notifications = Notifications\indexOnUser($mysqli, $idusers);

if ($notifications) {

    include_once '../fns/Page/imageArrowLink.php';
    $options[] = Page\imageArrowLink('Delete All Notifications',
        'delete-all/', 'trash-bin');

    include_once '../fns/create_image_text.php';

    foreach ($notifications as $i => $notification) {

        if ($i < $user->num_new_notifications) {
            $icon = 'notification';
        } else {
            $icon = 'old-notification';
        }

        $content =
            "<a class=\"a\" href=\"./in-channel/?id=$notification->idchannels\">"
                .$notification->channelname
            .'</a>: '
            .nl2br(
                preg_replace(
                    '#(http://.*?)(\s|$)#',
                    '<a class="a" rel="noreferrer" href="$1">$1</a>$2',
                    htmlspecialchars($notification->notificationtext)
                )
            );

        $items[] = create_image_text($content, $icon);

    }
} else {
    include_once '../fns/Page/info.php';
    $items[] = Page\info('No notifications.');
}

unset(
    $_SESSION['channels/index_messages'],
    $_SESSION['home/index_messages'],
    $_SESSION['notifications/in-channel/index_messages']
);

include_once '../fns/Page/sessionMessages.php';
$pageMessages = Page\sessionMessages('notifications/index_messages');

include_once '../fns/create_panel.php';
include_once '../fns/create_tabs.php';
$content =
    create_tabs(
        array(
            array(
                'title' => 'Home',
                'href' => '..',
            ),
        ),
        'Notifications',
        $pageMessages.join('<div class="hr"></div>', $items)
        .create_panel('Options', join('<div class="hr"></div>', $options))
    );

include_once '../fns/echo_page.php';
echo_page($user, 'Notifications', $content, '../');
