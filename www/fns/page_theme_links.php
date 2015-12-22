<?php

function page_theme_links ($theme_color, $theme_brightness, $base = '') {
    return '<link rel="stylesheet" type="text/css"'
        ." href=\"{$base}theme/color/$theme_color/common.css?31\" />"
        .'<link rel="stylesheet" type="text/css"'
        ." href=\"{$base}theme/brightness/$theme_brightness/common.css?7\" />";
}
