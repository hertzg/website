<?php

function create_page ($mysqli, $user, $base = '') {

    $id_users = $user->id_users;
    $fnsDir = __DIR__.'/../../fns';

    if ($user->num_new_notifications || $user->home_num_new_notifications) {
        include_once "$fnsDir/Users/Notifications/clearNumberNew.php";
        Users\Notifications\clearNumberNew($mysqli, $id_users);
    }

    include_once "$fnsDir/Paging/limit.php";
    $limit = Paging\limit();

    include_once "$fnsDir/request_strings.php";
    list($offset) = request_strings('offset');
    $offset = abs((int)$offset);
    if ($offset % $limit) {
        include_once "$fnsDir/redirect.php";
        redirect("$base./");
    }

    $options = [];

    include_once __DIR__.'/create_channels_link.php';
    $options[] = create_channels_link($user, $base);

    include_once __DIR__.'/create_subscribed_channels_link.php';
    $options[] = create_subscribed_channels_link($user, $base);

    $items = [];

    if ($user->num_notifications) {

        include_once "$fnsDir/Notifications/indexPageOnUser.php";
        $notifications = Notifications\indexPageOnUser($mysqli,
            $id_users, $offset, $limit, $total);

        include_once "$fnsDir/ItemList/escapedPageQuery.php";
        $escapedPageQuery = ItemList\escapedPageQuery();

        include_once "$fnsDir/Page/imageArrowLink.php";
        $title = 'Delete All Notifications';
        $href = "{$base}delete-all/$escapedPageQuery";
        $options[] =
            '<div id="deleteAllLink">'
                .Page\imageArrowLink($title, $href, 'trash-bin')
            .'</div>';

        include_once __DIR__.'/render_prev_button.php';
        render_prev_button($offset, $limit, $total, $items, [], $base);

        include_once "$fnsDir/create_image_text.php";
        include_once "$fnsDir/date_ago.php";
        include_once "$fnsDir/render_external_links.php";
        foreach ($notifications as $i => $notification) {

            if ($i < $user->num_new_notifications) $icon = 'notification';
            else $icon = 'old-notification';

            $id_subscribed_channels = $notification->id_subscribed_channels;
            if ($id_subscribed_channels) {
                $query = "?id=$id_subscribed_channels";
                $href = "{$base}in-subscribed-channel/$query";
            } else {
                $href = "{$base}in-channel/?id=$notification->id_channels";
            }

            $text = htmlspecialchars($notification->text);
            $text = nl2br(render_external_links($text, "$base../"));

            $content =
                $text
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

        include_once __DIR__.'/render_next_button.php';
        render_next_button($offset, $limit, $total, $items, [], $base);

    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = Page\info('No notifications');
    }

    include_once __DIR__.'/create_content.php';
    return create_content($items, $options, $base);

}
