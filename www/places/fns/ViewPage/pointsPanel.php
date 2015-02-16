<?php

namespace ViewPage;

function pointsPanel ($mysqli, $place) {

    if (!$place->num_points) return;

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/PlacePoints/indexOnPlace.php";
    $points = \PlacePoints\indexOnPlace($mysqli, $place->id);

    $items = [];

    include_once "$fnsDir/Page/removableItem.php";
    foreach ($points as $point) {
        $title = "$point->latitude $point->longitude";
        $altitude = $point->altitude;
        if ($altitude !== null) $title .= " $place->altitude";
        $items[] = \Page\removableItem($title, '', 'place');
    }

    include_once "$fnsDir/create_panel.php";
    return create_panel('Points', join('<div class="hr"></div>', $items));

}
