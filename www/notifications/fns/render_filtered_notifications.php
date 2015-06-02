<?php

function render_filtered_notifications ($base, $id, $offset,
    $limit, $total, $notifications, &$items, &$options, &$scripts) {

    $fnsDir = __DIR__.'/../../fns';

    if ($notifications) {

        include_once "$fnsDir/compressed_js_script.php";
        $scripts = compressed_js_script('dateAgo', "$base../../");

        include_once "$fnsDir/ItemList/escapedItemQuery.php";
        $escapedItemQuery = ItemList\escapedItemQuery($id);

        include_once "$fnsDir/Page/imageLink.php";
        $options[] =
            '<div id="deleteAllLink">'
                .Page\imageLink('Delete Notifications',
                    "{$base}delete-all/$escapedItemQuery", 'trash-bin')
            .'</div>';

        include_once __DIR__.'/render_prev_button.php';
        render_prev_button($offset, $limit, $total, $items, ['id' => $id]);

        include_once "$fnsDir/format_author.php";
        include_once "$fnsDir/render_external_links.php";
        include_once "$fnsDir/ItemList/escapedItemQuery.php";
        include_once "$fnsDir/Page/removableTextItem.php";
        foreach ($notifications as $notification) {

            $text = htmlspecialchars($notification->text);
            $text = nl2br(render_external_links($text, $base));

            $content = $text
                .'<div style="color: #777; font-size: 12px; line-height: 14px">'
                    .format_author($notification->insert_time,
                        $notification->insert_api_key_name)
                .'</div>';

            $items[] = Page\removableTextItem($content,
                "{$base}delete/".ItemList\escapedItemQuery($notification->id),
                'old-notification');

        }

        include_once __DIR__.'/render_next_button.php';
        render_next_button($offset, $limit, $total, $items, ['id' => $id]);

    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = Page\info('No notifications');
    }

}
