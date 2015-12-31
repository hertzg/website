<?php

namespace ViewPage;

function create ($receivedNote, &$scripts) {

    $id = $receivedNote->id;
    $base = '../../../';
    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', $base);

    include_once "$fnsDir/render_external_links.php";
    include_once "$fnsDir/Page/text.php";
    $text = htmlspecialchars($receivedNote->text);
    $text = render_external_links($text, $base);
    $items = [\Page\text(nl2br($text))];

    $tags = $receivedNote->tags;
    if ($tags !== '') $items[] = \Page\text('Tags: '.htmlspecialchars($tags));

    include_once "$fnsDir/export_date_ago.php";
    $date_ago = export_date_ago($receivedNote->insert_time);

    if ($receivedNote->encrypt_in_listings) {
        $infoText = 'Encrypted in listings.<br />';
    } else {
        $infoText = '';
    }
    $infoText .= "Note received $date_ago.";

    include_once __DIR__.'/optionsPanel.php';
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/create_received_from_item.php";
    include_once "$fnsDir/ItemList/Received/listHref.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return
        \Page\create(
            [
                'title' => 'Notes',
                'href' => \ItemList\Received\listHref('../')."#$id",
            ],
            "Received Note #$id",
            \Page\sessionMessages('notes/received/view/messages')
            .create_received_from_item($receivedNote)
        )
        .create_panel('The Note', join('<div class="hr"></div>', $items)
            .\Page\infoText($infoText))
        .optionsPanel($receivedNote);

}
