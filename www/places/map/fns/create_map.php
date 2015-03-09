<?php

function create_map ($places, $base = '') {

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
        '<div style="width: 360px; height: 180px; overflow: auto">'
            .'<svg class="map" viewBox="-180 -90 360 180"'
            .' style="vertical-align: top; width: 100%; height: 100%">'
                ."<g class=\"map-scale\" transform=\"scale($scale)\">"
                    .'<g class="map-translate" fill="hsla(7, 100%, 57%, 0.8)"'
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
            .'</svg>'
        .'</div>'
        .'<script type="text/javascript">'
            ."var scale = $scale\n"
            ."var x = $median_x\n"
            ."var y = $median_y"
        .'</script>'
        ."<script type=\"text/javascript\" src=\"{$base}index.js\"></script>";
}
