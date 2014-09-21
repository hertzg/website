<?php

function render_filtered_notifications ($base, $id, $offset,
    $limit, $total, $notifications, &$items, &$options) {

    $fnsDir = __DIR__.'/../../fns';

    if ($notifications) {

        include_once "$fnsDir/ItemList/escapedItemQuery.php";
        $escapedItemQuery = ItemList\escapedItemQuery($id);

        include_once "$fnsDir/Page/imageArrowLink.php";
        $title = 'Delete Notifications';
        $href = "{$base}delete/$escapedItemQuery";
        $options[] =
            '<div id="deleteLink">'
                .Page\imageArrowLink($title, $href, 'trash-bin')
            .'</div>';

        include_once __DIR__.'/render_prev_button.php';
        render_prev_button($offset, $limit,
            $total, $items, ['id' => $id], $base);

        include_once "$fnsDir/create_image_text.php";
        include_once "$fnsDir/date_ago.php";
        include_once "$fnsDir/render_external_links.php";
        foreach ($notifications as $notification) {

            $text = htmlspecialchars($notification->text);
            $text = nl2br(render_external_links($text, $base));

            $content = $text
                .'<div style="color: #777; font-size: 12px; line-height: 14px">'
                    .date_ago($notification->insert_time)
                .'</div>';
            $items[] = create_image_text($content, 'old-notification');

        }

        include_once __DIR__.'/render_next_button.php';
        render_next_button($offset, $limit,
            $total, $items, ['id' => $id], $base);

    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = Page\info('No notifications');
    }

}
