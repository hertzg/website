<?php

namespace ViewPage;

function create ($receivedCalculation, &$scripts) {

    $id = $receivedCalculation->id;
    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', '../../../');

    $items = [];

    include_once "$fnsDir/Page/text.php";

    $title = $receivedCalculation->title;
    if ($title !== '') $items[] = \Page\text(htmlspecialchars($title));

    $items[] = \Page\text(htmlspecialchars($receivedCalculation->expression));

    $items[] = \Page\text(number_format($receivedCalculation->value, 2));

    $tags = $receivedCalculation->tags;
    if ($tags !== '') $items[] = \Page\text('Tags: '.htmlspecialchars($tags));

    include_once "$fnsDir/export_date_ago.php";
    $date_ago = export_date_ago($receivedCalculation->insert_time);

    include_once __DIR__.'/optionsPanel.php';
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/create_received_from_item.php";
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
        "Received Calculation #$id",
        \Page\sessionMessages('calculations/received/view/messages')
        .create_received_from_item($receivedCalculation)
        .create_panel('The Calculation', join('<div class="hr"></div>', $items))
        .\Page\infoText("Calculation received $date_ago.")
        .optionsPanel($receivedCalculation)
    );

}
