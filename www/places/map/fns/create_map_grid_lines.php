<?php

function create_map_grid_lines () {
    $svg = '<g class="map-grid-lines">';
    for ($i = -180; $i <= 180; $i += 5) {
        $svg .= '<line class="map-gridline"'
            ." x1=\"$i\" y1=\"-90\" x2=\"$i\" y2=\"90\" />";
    }
    for ($i = -90; $i <= 90; $i += 5) {
        $svg .= '<line class="map-gridline"'
            ." x1=\"-180\" y1=\"$i\" x2=\"180\" y2=\"$i\" />";
    }
    $svg .= '</g>';
    return $svg;
}
