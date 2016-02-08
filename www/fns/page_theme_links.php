<?php

function page_theme_links ($theme_color, $theme_brightness, $base = '') {

    $color_href = "theme/color/$theme_color/common.css";
    $brightness_href = "theme/brightness/$theme_brightness/common.css";

    include_once __DIR__.'/get_revision.php';
    $color_href .= '?'.get_revision($color_href);
    $brightness_href .= '?'.get_revision($brightness_href);

    return '<link rel="stylesheet" type="text/css"'
        .' class="localNavigation-leave"'
        ." href=\"$base$color_href\" />"
        .'<link rel="stylesheet" type="text/css"'
        .' class="localNavigation-leave"'
        ." href=\"$base$brightness_href\" />";

}
