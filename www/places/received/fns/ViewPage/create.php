<?php

namespace ViewPage;

function create ($receivedPlace) {

    $id = $receivedPlace->id;
    $fnsDir = __DIR__.'/../../../../fns';

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

    $tags = $receivedPlace->tags;
    if ($tags !== '') $items[] = \Form\label('Tags', htmlspecialchars($tags));

    include_once "$fnsDir/date_ago.php";
    $text = 'Place received '.date_ago($receivedPlace->insert_time).'.';
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
        "Received Place #$id",
        \Page\sessionMessages('places/received/view/messages')
        .\Form\label('Received from',
            htmlspecialchars($receivedPlace->sender_username))
        .create_panel('The Place', join('<div class="hr"></div>', $items))
        .$infoText
        .optionsPanel($receivedPlace)
    );

}
