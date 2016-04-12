<?php

function create_map ($places, $base = '') {

    $maxScale = 20000;

    $num_places = count($places);
    if ($places) {
        $firstPlace = $places[0];
        $max_x = $min_x = $firstPlace->longitude;
        $max_y = $min_y = $firstPlace->latitude;
        if ($num_places > 1) {
            for ($i = 1; $i < $num_places; $i++) {
                $place = $places[$i];
                $min_x = min($min_x, $place->longitude);
                $min_y = min($min_y, $place->latitude);
                $max_x = max($max_x, $place->longitude);
                $max_y = max($max_y, $place->latitude);
            }
            $scale = 180 / max($max_y - $min_y, $max_x - $min_x);
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

    $classIndex = 0;
    $thisScale = $scale;
    while ($thisScale > 2) {
        $thisScale /= 2;
        $classIndex++;
    }
    $scaleClass = "scale$classIndex";

    $viewBox = "$viewBoxMinX $viewBoxMinY $viewBoxWidth $viewBoxHeight";
    $placePathData = 'm 0,-13.7 c -2.6,0 -4.3,1.7 -4.3,4.3 0,2.6 4.3,9.4'
        .' 4.3,9.4 0,0 4.3,-6.9 4.3,-9.4 0,-2.6 -1.7,-4.3 -4.3,-4.3 z';
    $translateStyle = "transform: translate(-{$median_x}px, {$median_y}px)";

    include_once __DIR__.'/create_map_grid_lines.php';
    include_once __DIR__.'/create_map_places.php';
    include_once __DIR__.'/create_map_style.php';
    return
        create_map_style()
        .'<div style="height: 400px; text-align: center">'
            ."<svg class=\"map $scaleClass\" viewBox=\"$viewBox\">"
                .'<defs>'
                    ."<path id=\"placePath\" d=\"$placePathData\" />"
                .'</defs>'
                ."<g class=\"map-scale\" style=\"transform: scale($scale)\">"
                    ."<g class=\"map-translate\" style=\"$translateStyle\">"
                        .create_map_grid_lines()
                        .create_map_places($places, $base)
                    .'</g>'
                .'</g>'
            .'</svg>'
        .'</div>'
        .'<script type="text/javascript">'
            ."var scale = $scale,"
                ."x = $median_x,"
                ."y = $median_y,"
                ."maxScale = $maxScale"
        .'</script>'
        ."<script type=\"text/javascript\" src=\"{$base}index.js?3\"></script>";
}
