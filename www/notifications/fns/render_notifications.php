<?php

function render_notifications ($user, $notifications, $offset, $base, &$items) {

    $fnsDir = __DIR__.'/../../fns';

    $index = $offset;
    include_once "$fnsDir/format_author.php";
    include_once "$fnsDir/render_external_links.php";
    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    include_once "$fnsDir/Page/removableTextItem.php";
    foreach ($notifications as $notification) {

        if ($index < $user->num_new_notifications) $icon = 'notification';
        else $icon = 'old-notification';

        $text = htmlspecialchars($notification->text);
        $text = nl2br(render_external_links($text, "$base../"));

        $author = format_author($notification->insert_time,
            $notification->insert_api_key_name);

        $content = $text
            .'<div class="imageText-description">'
                ."$notification->channel_name $author."
            .'</div>';

        $escapedItemQuery = ItemList\escapedItemQuery($notification->id);
        $delete_href = "{$base}delete/submit.php$escapedItemQuery";

        $items[] =
            '<div class="deleteLinkWrapper"'
            ." data-delete_href=\"$delete_href\">"
                .Page\removableTextItem($content,
                    "{$base}delete/$escapedItemQuery", $icon)
            .'</div>';

        $index++;

    }

}
