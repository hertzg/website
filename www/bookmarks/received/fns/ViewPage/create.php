<?php

namespace ViewPage;

function create ($receivedBookmark) {

    $id = $receivedBookmark->id;
    $fnsDir = __DIR__.'/../../../../fns';

    $items = [];

    include_once "$fnsDir/Page/text.php";

    $title = $receivedBookmark->title;
    if ($title !== '') $items[] = \Page\text(htmlspecialchars($title));

    $items[] = \Page\text(htmlspecialchars($receivedBookmark->url));

    $tags = $receivedBookmark->tags;
    if ($tags !== '') $items[] = \Page\text('Tags: '.htmlspecialchars($tags));

    include_once "$fnsDir/date_ago.php";
    $text = 'Bookmark received '.date_ago($receivedBookmark->insert_time).'.';
    include_once "$fnsDir/Page/infoText.php";
    $infoText = \Page\infoText($text);

    include_once __DIR__.'/optionsPanel.php';
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Form/label.php";
    include_once "$fnsDir/ItemList/Received/listHref.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return \Page\tabs(
        [
            [
                'title' => 'Received',
                'href' => '../'.\ItemList\Received\listHref()."#$id",
            ],
        ],
        "Received Bookmark #$id",
        \Page\sessionMessages('bookmarks/received/view/messages')
        .\Form\label('Received from',
            htmlspecialchars($receivedBookmark->sender_username))
        .create_panel('The Bookmark', join('<div class="hr"></div>', $items))
        .$infoText
        .optionsPanel($receivedBookmark)
    );

}
