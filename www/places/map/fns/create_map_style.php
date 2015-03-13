<?php

function create_map_style () {
    $html = '<style type="text/css">';
    $scale = 1;
    for ($i = 0; $i < 15; $i++) {
        $value = preg_replace('/\.?0+$/', '', number_format($scale, 30));
        $html .=
            ".scale$i .map-place {"
                ."transform: scale($value)"
            ."}"
            .".scale$i .map-gridline {"
                .'stroke-width: '.($value / 3).';'
            ."}";
        $scale /= 2;
    }
    $html .= '</style>';
    return $html;
}
