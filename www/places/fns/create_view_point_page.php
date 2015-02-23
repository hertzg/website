<?php

function create_view_point_page ($point) {

    $id = $point->id;
    $id_places = $point->id_places;
    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/format_author.php";
    $author = format_author($point->insert_time, $point->insert_api_key_name);
    $infoText = "Point created $author.";

    include_once "$fnsDir/Form/label.php";
    $content =
        Form\label('Latitude', $point->latitude)
        .'<div class="hr"></div>'
        .Form\label('Longitude', $point->longitude);

    $altitude = $point->altitude;
    if ($altitude !== null) {
        $content .=
            '<div class="hr"></div>'
            .Form\label('Altitude', $altitude);
    }

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = ItemList\escapedItemQuery($id);

    include_once "$fnsDir/Page/imageLink.php";
    $editLink = Page\imageLink('Edit',
        "../edit-point/$escapedItemQuery", 'edit-place');

    $deleteLink =
        '<div id="deleteLink">'
            .Page\imageLink('Delete',
                "../delete-point/$escapedItemQuery", 'trash-bin')
        .'</div>';

    include_once "$fnsDir/Page/staticTwoColumns.php";
    $optionsContent = Page\staticTwoColumns($editLink, $deleteLink);

    unset(
        $_SESSION['places/edit-point/errors'],
        $_SESSION['places/edit-point/values'],
        $_SESSION['places/view/messages']
    );

    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return Page\tabs(
        [
            [
                'title' => "Place #$id_places",
                'href' => '../view/'.ItemList\escapedItemQuery($id_places),
            ],
        ],
        "Point #$id",
        Page\sessionMessages('places/view-point/messages')
        .$content
        .Page\infoText($infoText)
        .create_panel('Point Options', $optionsContent)
    );

}
