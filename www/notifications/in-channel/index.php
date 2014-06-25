<?php

$base = '../../';

include_once 'fns/require_channel.php';
include_once '../../lib/mysqli.php';
list($channel, $id, $user) = require_channel($mysqli, '..');
$id_users = $user->id_users;

include_once '../../fns/Users/Notifications/clearNumberNew.php';
Users\Notifications\clearNumberNew($mysqli, $id_users);

include_once '../../fns/Paging/limit.php';
$limit = Paging\limit();

include_once '../../fns/request_strings.php';
list($offset) = request_strings('offset');
$offset = abs((int)$offset);
if ($offset % $limit) {
    include_once '../../fns/redirect.php';
    redirect('..');
}

$options = [];

include_once '../fns/create_channels_link.php';
$options[] = create_channels_link($user, '../');

include_once '../fns/create_subscribed_channels_link.php';
$options[] = create_subscribed_channels_link($user, '../');

$items = [];

include_once '../../fns/Notifications/indexPageOnUserChannel.php';
$notifications = Notifications\indexPageOnUserChannel(
    $mysqli, $id_users, $id, $offset, $limit, $total);

if ($notifications) {

    include_once '../../fns/Page/imageArrowLink.php';
    $title = 'Delete Notifications';
    $href = "delete/?id=$id";
    $options[] = Page\imageArrowLink($title, $href, 'trash-bin');

    include_once '../fns/render_prev_button.php';
    render_prev_button($offset, $limit, $total, $items, ['id' => $id]);

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
                    htmlspecialchars($notification->notification_text)
                )
            );

        $items[] = create_image_text($content, $icon);

    }

    include_once '../fns/render_next_button.php';
    render_next_button($offset, $limit, $total, $items, ['id' => $id]);

} else {
    include_once '../../fns/Page/info.php';
    $items[] = Page\info('No notifications');
}

unset(
    $_SESSION['home/messages'],
    $_SESSION['notifications/channels/messages'],
    $_SESSION['notifications/errors'],
    $_SESSION['notifications/messages']
);

include_once '../../fns/create_panel.php';
include_once '../../fns/Page/tabs.php';
include_once '../../fns/Page/sessionMessages.php';
$content = Page\tabs(
    [
        [
            'title' => 'Home',
            'href' => '../../home/',
        ],
    ],
    'Notifications',
    Page\sessionMessages('notifications/in-channel/messages')
    .'<div class="filterBar">'
        .'Channel: <b>'.htmlspecialchars($channel->channel_name).'</b>'
        .'<a class="clickable" title="Clear Filter" href="..">'
            .'<span class="icon no"></span>'
        .'</a>'
    .'</div>'
    .join('<div class="hr"></div>', $items)
    .create_panel('Options', join('<div class="hr"></div>', $options))
);

include_once '../../fns/echo_page.php';
echo_page($user, 'Notifications', $content, $base);
