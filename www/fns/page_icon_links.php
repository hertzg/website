<?php

function page_icon_links ($theme_color, $base = '') {
    $theme_images = "{$base}theme/color/$theme_color/images";
    return '<link rel="icon" type="image/png"'
        ." href=\"$theme_images/icon16.png?2\" />"
        .'<link rel="icon" type="image/png" sizes="32x32"'
        ." href=\"$theme_images/icon32.png?2\" />"
        .'<link rel="icon" type="image/png" sizes="48x48"'
        ." href=\"$theme_images/icon48.png?1\" />"
        .'<link rel="icon" type="image/png" sizes="64x64"'
        ." href=\"$theme_images/icon64.png?1\" />"
        .'<link rel="icon" type="image/png" sizes="90x90"'
        ." href=\"$theme_images/icon90.png?1\" />"
        .'<link rel="icon" type="image/png" sizes="120x120"'
        ." href=\"$theme_images/icon120.png?1\" />"
        .'<link rel="icon" type="image/png" sizes="128x128"'
        ." href=\"$theme_images/icon128.png?1\" />"
        .'<link rel="icon" type="image/png" sizes="256x256"'
        ." href=\"$theme_images/icon256.png?1\" />"
        .'<link rel="icon" type="image/png" sizes="512x512"'
        ." href=\"$theme_images/icon512.png?1\" />";
}
