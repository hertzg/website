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
        $options[] = Page\imageLink('Delete Notifications',
            "{$base}delete-all/$escapedItemQuery",
            'trash-bin', ['id' => 'delete-all']);

        include_once __DIR__.'/render_prev_button.php';
        render_prev_button($offset, $limit, $total, $items, ['id' => $id]);

        include_once "$fnsDir/format_author.php";
        include_once "$fnsDir/render_external_links.php";
        include_once "$fnsDir/ItemList/escapedItemQuery.php";
        include_once "$fnsDir/Page/removableItem.php";
        foreach ($notifications as $notification) {

            $text = htmlspecialchars($notification->text);
            $text = nl2br(render_external_links($text, "$base../../"));

            $content = $text
                .'<div class="imageText-description">'
                    .format_author($notification->insert_time,
                        $notification->insert_api_key_name)
                .'</div>';

            $escapedItemQuery = ItemList\escapedItemQuery($notification->id);
            $delete_href = "{$base}delete/submit.php$escapedItemQuery";

            $items[] =
                '<div class="deleteLinkWrapper"'
                ." data-delete_href=\"$delete_href\">"
                    .Page\removableItem($content,
                        "{$base}delete/$escapedItemQuery", 'old-notification')
                .'</div>';

        }

        include_once __DIR__.'/render_next_button.php';
        render_next_button($offset, $limit, $total, $items, ['id' => $id]);

    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = Page\info('No notifications');
    }

}
