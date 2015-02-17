<?php

namespace ViewPage;

function pointsPanel ($mysqli, $place) {

    if ($place->num_points < 2) return;

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/PlacePoints/indexOnPlace.php";
    $points = \PlacePoints\indexOnPlace($mysqli, $place->id);

    $items = [];

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    include_once "$fnsDir/Page/removableItem.php";
    foreach ($points as $point) {

        $escapedItemQuery = \ItemList\escapedItemQuery($point->id);
        $delete_url = "../delete-point/submit.php$escapedItemQuery";
        $href = "../delete-point/$escapedItemQuery";

        $title = "$point->latitude $point->longitude";
        $altitude = $point->altitude;
        if ($altitude !== null) $title .= " $point->altitude";

        $items[] =
            "<div class=\"deleteLinkWrapper\" data-delete_url=\"$delete_url\">"
                .\Page\removableItem($title, $href, 'place')
            .'</div>';

    }

    include_once "$fnsDir/create_panel.php";
    return create_panel('Points', join('<div class="hr"></div>', $items));

}
