<?php

namespace ViewPage;

function create ($place) {

    $id = $place->id;
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Form/label.php";
    $items = [
        \Form\label('Latitude', $place->latitude),
        \Form\label('Longitude', $place->longitude),
    ];

    $altitude = $place->altitude;
    if ($altitude !== null) $items[] = \Form\label('Altitude', $altitude);

    $name = $place->name;
    if ($name !== '') {
        $items[] = \Form\label('Name', htmlspecialchars($name));
    }

    if ($place->num_tags) {
        include_once "$fnsDir/Form/tags.php";
        $items[] = \Form\tags('../', json_decode($place->tags_json));
    }

    include_once "$fnsDir/format_author.php";
    $author = format_author($place->insert_time, $place->insert_api_key_name);
    $infoText = "Place created $author.";
    if ($place->revision) {
        $author = format_author($place->update_time,    
            $place->update_api_key_name);
        $infoText .= "<br />Last modified $author.";
    }

    include_once __DIR__.'/optionsPanel.php';
    include_once "$fnsDir/create_new_item_button.php";
    include_once "$fnsDir/ItemList/listHref.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return
        \Page\tabs(
            [
                [
                    'title' => 'Places',
                    'href' => \ItemList\listHref()."#$id",
                ],
            ],
            "Place #$id",
            \Page\sessionMessages('places/view/messages')
            .join('<div class="hr"></div>', $items)
            .\Page\infoText($infoText),
            create_new_item_button('Place', '../')
        )
        .optionsPanel($place);

}
