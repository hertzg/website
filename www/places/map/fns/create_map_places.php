<?php

function create_map_places ($places, $base) {
    include_once __DIR__.'/../../../fns/ItemList/itemQuery.php';
    $svg = '<g class="map-places">';
    foreach ($places as $place) {
        $href = "$base../view/".ItemList\itemQuery($place->id);
        $x = $place->longitude;
        $y = -$place->latitude;
        $svg .=
            "<a xlink:href=\"$href\" transform=\"translate($x, $y)\">"
                .'<use class="map-place" xlink:href="#placePath" />'
            .'</a>';
    }
    $svg .= '</g>';
    return $svg;
}
