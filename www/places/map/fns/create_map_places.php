<?php

function create_map_places ($places) {
    $svg = '<g class="map-places">';
    foreach ($places as $place) {
        $x = $place->longitude;
        $y = -$place->latitude;
        $svg .=
            "<g transform=\"translate($x, $y)\">"
                .'<use class="map-place" xlink:href="#placePath" />'
            .'</g>';
    }
    $svg .= '</g>';
    return $svg;
}
