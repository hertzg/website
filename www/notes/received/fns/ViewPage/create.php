<?php

namespace ViewPage;

function create ($receivedNote) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/render_external_links.php";
    include_once "$fnsDir/Page/text.php";
    $text = htmlspecialchars($receivedNote->text);
    $items = [
        \Page\text(
            nl2br(
                render_external_links($text, '../../../')
            )
        )
    ];

    $tags = $receivedNote->tags;
    if ($tags !== '') $items[] = \Page\text('Tags: '.htmlspecialchars($tags));

    include_once "$fnsDir/date_ago.php";
    $text = 'Note received '.date_ago($receivedNote->insert_time).'.';
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
                'href' => '../'.\ItemList\Received\listHref(),
            ],
        ],
        "Received Note #$receivedNote->id",
        \Page\sessionMessages('notes/received/view/messages')
        .\Form\label('Received from',
            htmlspecialchars($receivedNote->sender_username))
        .create_panel('The Note', join('<div class="hr"></div>', $items))
        .$infoText
        .optionsPanel($receivedNote)
    );

}
