<?php

namespace ViewPage;

function pointsPanel ($mysqli, $place) {

    $fnsDir = __DIR__.'/../../../fns';

    $items = [];

    if ($place->num_place_points) {

        include_once "$fnsDir/PlacePoints/indexOnPlace.php";
        $points = \PlacePoints\indexOnPlace($mysqli, $place->id);

        include_once "$fnsDir/Page/removableItem.php";
        foreach ($points as $point) {
            $title = "$point->latitude $point->longitude";
            $altitude = $point->altitude;
            if ($altitude !== null) $title .= " $place->altitude";
            $items[] = \Page\removableItem($title, '', 'place');
        }

    } else {
        include_once "$fnsDir/Page/info.php";
        $items = \Page\info('No points');
    }

    include_once "$fnsDir/create_panel.php";
    return create_panel('Points', join('<div class="hr"></div>', $items));

}
