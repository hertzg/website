<?php

namespace ViewPage;

function create ($receivedPlace, &$scripts) {

    $id = $receivedPlace->id;
    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', '../../../');

    include_once "$fnsDir/Form/label.php";
    $name = htmlspecialchars($receivedPlace->name);
    $items = [
        \Form\label('Latitude', $receivedPlace->latitude),
        \Form\label('Longitude', $receivedPlace->longitude),
    ];

    $altitude = $receivedPlace->altitude;
    if ($altitude !== null) $items[] = \Form\label('Altitude', $altitude);

    $name = $receivedPlace->name;
    if ($name !== '') {
        $items[] = \Form\label('Name', htmlspecialchars($name));
    }

    $description = $receivedPlace->description;
    if ($description !== '') {
        $description = nl2br(htmlspecialchars($description));
        $items[] = \Form\label('Description', $description);
    }

    $tags = $receivedPlace->tags;
    if ($tags !== '') $items[] = \Form\label('Tags', htmlspecialchars($tags));

    include_once "$fnsDir/export_date_ago.php";
    $date_ago = export_date_ago($receivedPlace->insert_time);

    include_once __DIR__.'/optionsPanel.php';
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/create_received_from_item.php";
    include_once "$fnsDir/ItemList/Received/listHref.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return \Page\create(
        [
            'title' => 'Received',
            'href' => '../'.\ItemList\Received\listHref()."#$id",
        ],
        "Received Place #$id",
        \Page\sessionMessages('places/received/view/messages')
        .create_received_from_item($receivedPlace)
        .create_panel('The Place', join('<div class="hr"></div>', $items))
        .\Page\infoText("Place received $date_ago.")
        .optionsPanel($receivedPlace)
    );

}
