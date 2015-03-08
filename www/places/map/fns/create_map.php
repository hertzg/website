<?php

function create_map ($places) {

    $radius = 2;

    $num_places = count($places);
    if ($places) {
        $firstPlace = $places[0];
        $max_x = $min_x = $firstPlace->longitude;
        $max_y = $min_y = $firstPlace->latitude;
        if ($num_places > 1) {
            foreach ($places as $place) {
                $min_x = min($min_x, $place->longitude);
                $min_y = min($min_y, $place->latitude);
                $max_x = max($max_x, $place->longitude);
                $max_y = max($max_y, $place->latitude);
            }
            $scale = 180 / max($max_y - $min_y, $max_x - $min_x);
            $scale = min(100000, $scale);
        } else {
            $scale = 180;
        }
        $median_x = ($max_x + $min_x) / 2;
        $median_y = ($max_y + $min_y) / 2;
        $radius *= 1 / $scale;
    } else {
        $median_x = $median_y = 0;
        $scale = 1;
    }

    return
        '<svg viewBox="-180 -90 360 180" style="vertical-align: top">'
            ."<g transform=\"scale($scale)\">"
                .'<g fill="rgba(0, 0, 0, 0.5)"'
                ." transform=\"translate(-$median_x, $median_y)\">"
                    .join('', array_map(function ($place) use ($radius) {
                        $cx = $place->longitude;
                        $cy = -$place->latitude;
                        return
                            "<circle cx=\"$cx\" cy=\"$cy\" r=\"0.0005\">"
                            ."</circle>";
                    }, $places))
                .'</g>'
            .'</g>'
        .'</svg>';
}
