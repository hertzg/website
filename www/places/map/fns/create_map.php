<?php

function create_map ($places, $base = '') {

    $maxScale = 20000;

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
            $scale = min($maxScale, $scale);
        } else {
            $scale = $maxScale;
        }
        $median_x = ($max_x + $min_x) / 2;
        $median_y = ($max_y + $min_y) / 2;
    } else {
        $median_x = $median_y = 0;
        $scale = $maxScale;
    }

    $viewBoxWidth = 360;
    $viewBoxHeight = 180;
    $viewBoxMinX = -$viewBoxWidth / 2;
    $viewBoxMinY = -$viewBoxHeight / 2;

    usort($places, function ($a, $b) {
        return $a->latitude > $b->latitude ? -1 : 1;
    });

    $lines = '';
    for ($i = -180; $i <= 180; $i++) {
        $lines .= '<line class="map-gridline"'
            ." x1=\"$i\" y1=\"-90\" x2=\"$i\" y2=\"90\" />";
    }
    for ($i = -90; $i <= 90; $i++) {
        $lines .= '<line class="map-gridline"'
            ." x1=\"-180\" y1=\"$i\" x2=\"180\" y2=\"$i\" />";
    }

    return
        '<div style="height: 400px; text-align: center">'
            .'<svg class="map"'
            ." viewBox=\"$viewBoxMinX $viewBoxMinY $viewBoxWidth $viewBoxHeight\">"
                ."<g class=\"map-scale\" style=\"transform: scale($scale)\">"
                    .'<g class="map-translate"'
                    ." style=\"transform: translate(-{$median_x}px, {$median_y}px)\">"
                        .$lines
                        .join('', array_map(function ($place) {
                            $x = $place->longitude;
                            $y = -$place->latitude;
                            return
                                "<path class=\"map-place\" transform=\"translate($x, $y)\""
                                .' d="m 0,-13.7 c -2.6,0 -4.3,1.7 -4.3,4.3 0,2.6 4.3,9.4 4.3,9.4 0,0 4.3,-6.9 4.3,-9.4 0,-2.6 -1.7,-4.3 -4.3,-4.3 z" />';
                        }, $places))
                    .'</g>'
                .'</g>'
            .'</svg>'
        .'</div>'
        .'<script type="text/javascript">'
            ."var scale = $scale\n"
            ."var x = $median_x\n"
            ."var y = $median_y\n"
            ."var viewBoxWidth = $viewBoxWidth\n"
            ."var viewBoxHeight = $viewBoxHeight\n"
            ."var maxScale = $maxScale"
        .'</script>'
        ."<script type=\"text/javascript\" src=\"{$base}index.js\"></script>";
}
