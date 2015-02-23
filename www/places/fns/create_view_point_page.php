<?php

function create_view_point_page ($point) {

    $id = $point->id;
    $id_places = $point->id_places;
    $fnsDir = __DIR__.'/../../fns';

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
    include_once "$fnsDir/Page/imageLink.php";
    $deleteLink =
        '<div id="deleteLink">'
            .Page\imageLink('Delete',
                '../delete-point/'.ItemList\escapedItemQuery($id), 'trash-bin')
        .'</div>';

    unset($_SESSION['places/view/messages']);

    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/tabs.php";
    return Page\tabs(
        [
            [
                'title' => "Place #$id_places",
                'href' => '../view/'.ItemList\escapedItemQuery($id_places),
            ],
        ],
        "Point #$id",
        $content.create_panel('Point Options', $deleteLink)
    );

}
