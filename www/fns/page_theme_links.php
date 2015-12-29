<?php

function page_theme_links ($theme_color, $theme_brightness, $base = '') {
    include_once __DIR__.'/get_revision.php';
    $color_href = "theme/color/$theme_color/common.css";
    return '<link rel="stylesheet" type="text/css"'
        ." href=\"{$base}$color_href?".get_revision($color_href).'" />'
        .'<link rel="stylesheet" type="text/css"'
        ." href=\"{$base}theme/brightness/$theme_brightness/common.css?8\" />";
}
