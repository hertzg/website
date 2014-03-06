<?php

include_once '../../fns/require_user.php';
require_user('../../');

include_once '../../fns/request_strings.php';
list($id) = request_strings('id');

$id = abs((int)$id);

include_once '../../fns/Channels/get.php';
include_once '../../lib/mysqli.php';
$channel = Channels\get($mysqli, $user->idusers, $id);

if (!$channel) {
    include_once '../../fns/redirect.php';
    redirect('..');
}

include_once '../../lib/page.php';

include_once '../../fns/Users/clearNumNewNotifications.php';
Users\clearNumNewNotifications($mysqli, $idusers);

include_once '../fns/create_channels_link.php';
$options = array(create_channels_link($user, '../../channels/'));

$items = array();

$num_new_notifications = $user->num_new_notifications;

include_once '../../fns/Notifications/indexOnUserChannel.php';
$notifications = Notifications\indexOnUserChannel($mysqli, $idusers, $id);

if ($notifications) {

    $title = 'Delete Notifications';
    $href = "delete/?id=$id";
    $options[] = Page::imageArrowLink($title, $href, 'trash-bin');

    include_once '../../fns/create_image_text.php';

    foreach ($notifications as $i => $notification) {
        $icon = $i < $num_new_notifications ? 'notification' : 'old-notification';
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

$key = 'notifications/in-channel/index_messages';
if (array_key_exists($key, $_SESSION)) {
    include_once '../../fns/Page/messages.php';
    $pageMessages = Page\messages($_SESSION[$key]);
} else {
    $pageMessages = '';
}

include_once '../../fns/create_panel.php';
include_once '../../fns/create_tabs.php';

$page->base = '../../';
$page->title = 'Notifications';
$page->finish(
    create_tabs(
        array(
            array(
                'title' => 'Home',
                'href' => '../..',
            ),
        ),
        'Notifications',
        $pageMessages
        .'<div class="filterBar">'
            .'Channel: <b>'.htmlspecialchars($channel->channelname).'</b>'
            .'<a class="clickable" title="Clear Filter" href="..">'
                .'<span class="icon no"></span>'
            .'</a>'
        .'</div>'
        .'<div class="warnings-hr"></div>'
        .join(Page::HR, $items)
        .create_panel('Options', join(Page::HR, $options))
    )
);
