<?php

$base = '../';

include_once '../fns/require_user.php';
$user = require_user($base);
$idusers = $user->idusers;

include_once '../fns/Users/clearNumNewNotifications.php';
include_once '../lib/mysqli.php';
Users\clearNumNewNotifications($mysqli, $idusers);

include_once 'fns/create_channels_link.php';
$options = array(create_channels_link($user));

$title = 'Other Channels';
$href = 'subscribed-channels/';
$icon = 'subscribed-channels';
$num_subscribed_channels = $user->num_subscribed_channels;
if ($num_subscribed_channels) {
    $description = "$num_subscribed_channels total.";
    include_once '../fns/Page/imageArrowLinkWithDescription.php';
    $options[] = Page\imageArrowLinkWithDescription($title,
        $description, $href, $icon);
} else {
    include_once '../fns/Page/imageArrowLink.php';
    $options[] = Page\imageArrowLink($title, $href, $icon);
}

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

        $id_subscribed_channels = $notification->id_subscribed_channels;
        if ($id_subscribed_channels) {
            $href = "in-channel/?id_subscribed_channels=$id_subscribed_channels";
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

unset(
    $_SESSION['channels/errors'],
    $_SESSION['channels/messages'],
    $_SESSION['home/messages'],
    $_SESSION['notifications/in-channel/messages']
);

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
