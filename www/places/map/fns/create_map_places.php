<?php

function create_map_places ($places) {
    $svg = '<g class="map-places">';
    foreach ($places as $place) {
        $x = $place->longitude;
        $y = -$place->latitude;
        $svg .=
            "<g transform=\"translate($x, $y)\">"
                .'<path class="map-place"'
                .' d="m 0,-13.7 c -2.6,0 -4.3,1.7 -4.3,4.3 0,2.6 4.3,9.4 4.3,9.4 0,0 4.3,-6.9 4.3,-9.4 0,-2.6 -1.7,-4.3 -4.3,-4.3 z" />'
            .'</g>';
    }
    $svg .= '</g>';
    return $svg;
}
