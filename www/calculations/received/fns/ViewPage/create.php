<?php

namespace ViewPage;

function create ($receivedCalculation, &$scripts) {

    $id = $receivedCalculation->id;
    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', '../../../');

    $items = [];

    $title = $receivedCalculation->title;
    if ($title !== '') {
        include_once "$fnsDir/Page/text.php";
        $items[] = \Page\text(htmlspecialchars($title));
    }

    include_once "$fnsDir/Form/label.php";
    $items[] = \Form\label('Expression',
        htmlspecialchars($receivedCalculation->expression));

    $tags = $receivedCalculation->tags;
    if ($tags !== '') $items[] = \Form\label('Tags', htmlspecialchars($tags));

    include_once "$fnsDir/calculation_value.php";
    $items[] = calculation_value($receivedCalculation);

    include_once "$fnsDir/export_date_ago.php";
    $date_ago = export_date_ago($receivedCalculation->insert_time);

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
                'title' => 'Calculations',
                'href' => \ItemList\Received\listHref('../')."#$id",
            ],
            "Received Calculation #$id",
            \Page\sessionMessages('calculations/received/view/messages')
            .create_received_from_item($receivedCalculation)
        )
        .\Page\panel('The Calculation', join('<div class="hr"></div>', $items)
            .\Page\infoText("Calculation received $date_ago."))
        .optionsPanel($receivedCalculation);

}
