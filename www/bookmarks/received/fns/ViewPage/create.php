<?php

namespace ViewPage;

function create ($receivedBookmark, &$scripts) {

    $id = $receivedBookmark->id;
    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', '../../../');

    $items = [];

    include_once "$fnsDir/Page/text.php";

    $title = $receivedBookmark->title;
    if ($title !== '') $items[] = \Page\text(htmlspecialchars($title));

    $items[] = \Page\text(htmlspecialchars($receivedBookmark->url));

    $tags = $receivedBookmark->tags;
    if ($tags !== '') $items[] = \Page\text('Tags: '.htmlspecialchars($tags));

    include_once "$fnsDir/export_date_ago.php";
    $date_ago = export_date_ago($receivedBookmark->insert_time);

    include_once __DIR__.'/optionsPanel.php';
    include_once "$fnsDir/Page/panel.php";
    include_once "$fnsDir/create_received_from_item.php";
    include_once "$fnsDir/ItemList/Received/listHref.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return
        \Page\create(
            [
                'title' => 'Bookmarks',
                'href' => \ItemList\Received\listHref('../')."#$id",
            ],
            "Received Bookmark #$id",
            \Page\sessionMessages('bookmarks/received/view/messages')
            .create_received_from_item($receivedBookmark)
        )
        .\Page\panel('The Bookmark', join('<div class="hr"></div>', $items)
            .\Page\infoText("Bookmark received $date_ago."))
        .optionsPanel($receivedBookmark);

}
