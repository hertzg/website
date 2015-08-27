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

    include_once __DIR__.'/optionsPanel.php';
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Form/label.php";
    include_once "$fnsDir/ItemList/Received/listHref.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return \Page\tabs(
        [
            [
                'title' => 'Received',
                'href' => '../'.\ItemList\Received\listHref()."#$id",
            ],
        ],
        "Received Note #$id",
        \Page\sessionMessages('notes/received/view/messages')
        .\Form\label('Received from',
            htmlspecialchars($receivedNote->sender_username))
        .create_panel('The Note', join('<div class="hr"></div>', $items))
        .\Page\infoText(
            ($receivedNote->encrypt ? 'Encrypted in listings.<br />' : '')
            ."Note received $date_ago."
        )
        .optionsPanel($receivedNote)
    );

}
