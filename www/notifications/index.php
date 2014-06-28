<?php

$base = '../';

include_once '../fns/require_user.php';
$user = require_user($base);
$id_users = $user->id_users;

include_once '../fns/Users/Notifications/clearNumberNew.php';
include_once '../lib/mysqli.php';
Users\Notifications\clearNumberNew($mysqli, $id_users);

include_once '../fns/Paging/limit.php';
$limit = Paging\limit();

include_once '../fns/request_strings.php';
list($offset) = request_strings('offset');
$offset = abs((int)$offset);
if ($offset % $limit) {
    include_once '../fns/redirect.php';
    redirect();
}

$options = [];

include_once 'fns/create_channels_link.php';
$options[] = create_channels_link($user);

include_once 'fns/create_subscribed_channels_link.php';
$options[] = create_subscribed_channels_link($user);

$items = [];

include_once '../fns/Notifications/indexPageOnUser.php';
$notifications = Notifications\indexPageOnUser($mysqli,
    $id_users, $offset, $limit, $total);

if ($notifications) {

    include_once '../fns/Page/imageArrowLink.php';
    $options[] = Page\imageArrowLink('Delete All Notifications',
        'delete-all/', 'trash-bin');

    include_once 'fns/render_prev_button.php';
    render_prev_button($offset, $limit, $total, $items);

    include_once '../fns/create_image_text.php';
    include_once '../fns/date_ago.php';
    foreach ($notifications as $i => $notification) {

        if ($i < $user->num_new_notifications) $icon = 'notification';
        else $icon = 'old-notification';

        $id_subscribed_channels = $notification->id_subscribed_channels;
        if ($id_subscribed_channels) {
            $href = "in-subscribed-channel/?id=$id_subscribed_channels";
        } else {
            $href = "in-channel/?id=$notification->id_channels";
        }

        $content =
            nl2br(
                preg_replace(
                    '#(http://.*?)(\s|$)#',
                    '<a class="a" rel="noreferrer" href="$1">$1</a>$2',
                    htmlspecialchars($notification->text)
                )
            )
            .'<div style="color: #555">'
                ."<a class=\"a\" href=\"$href\">"
                    .$notification->channel_name
                .'</a>'
                .' <span style="font-size: 12px; line-height: 14px">'
                    .date_ago($notification->insert_time)
                .'</span>'
            .'</div>';

        $items[] = create_image_text($content, $icon);

    }

    include_once 'fns/render_next_button.php';
    render_next_button($offset, $limit, $total, $items);

} else {
    include_once '../fns/Page/info.php';
    $items[] = Page\info('No notifications');
}

include_once 'fns/unset_session_vars.php';
unset_session_vars();

include_once 'fns/create_content.php';
$content = create_content($items, $options);

include_once '../fns/echo_page.php';
echo_page($user, 'Notifications', $content, $base);
