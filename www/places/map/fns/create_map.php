<?php

function create_map ($places) {

    $radius = 2;

    $num_places = count($places);
    if ($places) {
        $firstPlace = $places[0];
        $max_latitude = $min_latitude = $firstPlace->latitude;
        $max_longitude = $min_longitude = $firstPlace->longitude;
        if ($num_places > 1) {
            foreach ($places as $place) {
                $max_latitude = max($max_latitude, $place->latitude);
                $max_longitude = max($max_longitude, $place->longitude);
                $min_latitude = min($min_latitude, $place->latitude);
                $min_longitude = min($min_longitude, $place->longitude);
            }
            $scale = 180 / max($max_latitude - $min_latitude, $max_longitude - $min_longitude);
            $scale = min(100000, $scale);
        } else {
            $scale = 180;
        }
        $median_latitude = ($max_latitude + $min_latitude) / 2;
        $median_longitude = ($max_longitude + $min_longitude) / 2;
        $radius *= 1 / $scale;
    } else {
        $median_latitude = $median_longitude = 0;
        $scale = 1;
    }

    $opacity = $num_places ? (0.3 + 0.3 / $num_places) : 1;

    return
        '<svg viewBox="-180 -90 360 180" style="vertical-align: top">'
            ."<g transform=\"scale($scale)\">"
                .'<g class="Clickable"'
                ." transform=\"translate(-$median_longitude, $median_latitude)\""
                ." fill=\"rgba(0, 0, 0, $opacity)\">"
                    .join('', array_map(function ($place) use ($radius) {
                        $cx = $place->longitude;
                        $cy = -$place->latitude;
                        return
                            "<circle cx=\"$cx\" cy=\"$cy\" r=\"$radius\">"
                            ."</circle>"
                            ."<circle cx=\"$cx\" cy=\"$cy\" r=\"".($radius / 4)."\">"
                            ."</circle>";
                    }, $places))
                .'</g>'
            .'</g>'
        .'</svg>';
}
