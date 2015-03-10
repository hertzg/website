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

    $viewBoxWidth = 360;
    $viewBoxHeight = 180;
    $viewBoxMinX = -$viewBoxWidth / 2;
    $viewBoxMinY = -$viewBoxHeight / 2;

    usort($places, function ($a, $b) {
        return $a->latitude > $b->latitude ? -1 : 1;
    });

    return
        '<div style="height: 400px; text-align: center">'
            .'<svg class="map"'
            ." viewBox=\"$viewBoxMinX $viewBoxMinY $viewBoxWidth $viewBoxHeight\">"
                ."<g class=\"map-scale\" style=\"transform: scale($scale)\">"
                    .'<g class="map-translate"'
                    ." style=\"transform: translate(-{$median_x}px, {$median_y}px)\">"
                        .join('', array_map(function ($place) use ($radius) {
                            $x = $place->longitude;
                            $y = -$place->latitude;
                            return
                                "<path transform=\"translate($x, $y) scale(0.0001)\""
                                .' d="m 0,0 c -2.571056 0 -4.285,1.7141 -4.285,4.2851 0,2.5711 4.285,9.4272 4.285,9.4272 0,0 4.285094,-6.8561 4.285094,-9.4272 0,-2.571 -1.714037,-4.2851 -4.285094,-4.2851 z" />';
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
            ."var viewBoxHeight = $viewBoxHeight"
        .'</script>'
        ."<script type=\"text/javascript\" src=\"{$base}index.js\"></script>";
}
