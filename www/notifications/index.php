<?php

$base = '../';

include_once '../fns/require_user.php';
$user = require_user($base);
$idusers = $user->idusers;

include_once '../fns/Users/clearNumNewNotifications.php';
include_once '../lib/mysqli.php';
Users\clearNumNewNotifications($mysqli, $idusers);

$options = [];

include_once 'fns/create_channels_link.php';
$options[] = create_channels_link($user);

include_once 'fns/create_subscribed_channels_link.php';
$options[] = create_subscribed_channels_link($user);

$items = [];

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

        $id_subscribed_channels = $notification->id_subscribed_channels;
        if ($id_subscribed_channels) {
            $href = "in-subscribed-channel/?id=$id_subscribed_channels";
        } else {
            $href = "in-channel/?id=$notification->idchannels";
        }

        $content =
            "<a class=\"a\" href=\"$href\">"
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

include_once 'fns/unset_session_vars.php';
unset_session_vars();

include_once '../fns/create_panel.php';
include_once '../fns/create_tabs.php';
include_once '../fns/Page/sessionErrors.php';
include_once '../fns/Page/sessionMessages.php';
$content = create_tabs(
    array(
        array(
            'title' => 'Home',
            'href' => '../home/',
        ),
    ),
    'Notifications',
    Page\sessionErrors('notifications/errors')
    .Page\sessionMessages('notifications/messages')
    .join('<div class="hr"></div>', $items)
    .create_panel('Options', join('<div class="hr"></div>', $options))
);

include_once '../fns/echo_page.php';
echo_page($user, 'Notifications', $content, $base);
