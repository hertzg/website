<?php

$base = '../../';

include_once 'fns/require_channel.php';
include_once '../../lib/mysqli.php';
list($channel, $id, $user) = require_channel($mysqli, '../../', '..');
$idusers = $user->idusers;

include_once '../../fns/Users/clearNumNewNotifications.php';
Users\clearNumNewNotifications($mysqli, $idusers);

include_once '../fns/create_channels_link.php';
$options = array(create_channels_link($user, '../../channels/'));

$items = array();

include_once '../../fns/Notifications/indexOnUserChannel.php';
$notifications = Notifications\indexOnUserChannel($mysqli, $idusers, $id);

if ($notifications) {

    include_once '../../fns/Page/imageArrowLink.php';
    $title = 'Delete Notifications';
    $href = "delete/?id=$id";
    $options[] = Page\imageArrowLink($title, $href, 'trash-bin');

    include_once '../../fns/create_image_text.php';

    foreach ($notifications as $i => $notification) {

        if ($i < $user->num_new_notifications) {
            $icon = 'notification';
        } else {
            $icon = 'old-notification';
        }

        $content =
            nl2br(
                preg_replace(
                    '#(http://.*?)(\s|$)#',
                    '<a class="a" rel="noreferrer" href="$1">$1</a>$2',
                    htmlspecialchars($notification->notificationtext)
                )
            );

        $items[] = create_image_text($content, $icon);

    }
} else {
    include_once '../../fns/Page/info.php';
    $items[] = Page\info('No notifications.');
}

unset(
    $_SESSION['channels/index_messages'],
    $_SESSION['home/index_messages'],
    $_SESSION['notifications/index_messages']
);

include_once '../../fns/create_panel.php';
include_once '../../fns/create_tabs.php';
include_once '../../fns/Page/sessionMessages.php';
$content =
    create_tabs(
        array(
            array(
                'title' => 'Home',
                'href' => '../../home/',
            ),
        ),
        'Notifications',
        Page\sessionMessages('notifications/in-channel/index_messages')
        .'<div class="filterBar">'
            .'Channel: <b>'.htmlspecialchars($channel->channelname).'</b>'
            .'<a class="clickable" title="Clear Filter" href="..">'
                .'<span class="icon no"></span>'
            .'</a>'
        .'</div>'
        .'<div class="hr"></div>'
        .join('<div class="hr"></div>', $items)
        .create_panel('Options', join('<div class="hr"></div>', $options))
    );

include_once '../../fns/echo_page.php';
echo_page($user, 'Notifications', $content, $base);
