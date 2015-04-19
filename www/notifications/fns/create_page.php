<?php

function create_page ($mysqli, $user, &$scripts, $base = '') {

    $id_users = $user->id_users;
    $fnsDir = __DIR__.'/../../fns';

    if ($user->num_new_notifications || $user->home_num_new_notifications) {
        include_once "$fnsDir/Users/Notifications/clearNumberNew.php";
        Users\Notifications\clearNumberNew($mysqli, $id_users);
    }

    include_once "$fnsDir/Paging/limit.php";
    $limit = Paging\limit();

    include_once "$fnsDir/Paging/requestOffset.php";
    $offset = Paging\requestOffset();

    $options = [];

    include_once __DIR__.'/create_channels_link.php';
    $options[] = create_channels_link($user, $base);

    include_once __DIR__.'/create_subscribed_channels_link.php';
    $options[] = create_subscribed_channels_link($user, $base);

    $items = [];

    if ($user->num_notifications) {

        include_once "$fnsDir/compressed_js_script.php";
        $scripts = compressed_js_script('dateAgo', "$base../");

        include_once "$fnsDir/Notifications/indexPageOnUser.php";
        $notifications = Notifications\indexPageOnUser($mysqli,
            $id_users, $offset, $limit, $total);

        include_once "$fnsDir/check_offset_overflow.php";
        check_offset_overflow($offset, $limit, $total, []);

        include_once "$fnsDir/ItemList/escapedPageQuery.php";
        $escapedPageQuery = ItemList\escapedPageQuery();

        include_once "$fnsDir/Page/imageLink.php";
        $href = "{$base}delete-all/$escapedPageQuery";
        $options[] =
            '<div id="deleteAllLink">'
                .Page\imageLink('Delete All Notifications', $href, 'trash-bin')
            .'</div>';

        include_once __DIR__.'/render_prev_button.php';
        render_prev_button($offset, $limit, $total, $items, [], $base);

        include_once "$fnsDir/create_image_text.php";
        include_once "$fnsDir/format_author.php";
        include_once "$fnsDir/render_external_links.php";
        foreach ($notifications as $i => $notification) {

            if ($i < $user->num_new_notifications) $icon = 'notification';
            else $icon = 'old-notification';

            $text = htmlspecialchars($notification->text);
            $text = nl2br(render_external_links($text, "$base../"));

            $author = format_author($notification->insert_time,
                $notification->insert_api_key_name);

            $content =
                $text
                .'<div style="color: #555; font-size: 12px; line-height: 14px">'
                    ."$notification->channel_name $author."
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
    return create_content($mysqli, $user, $items, $options, $base);

}
