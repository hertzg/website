<?php

function page_icon_links ($theme_color, $base = '') {

    include_once __DIR__.'/get_revision.php';
    $create_link = function ($size) use ($base, $theme_color) {
        $path = "theme/color/$theme_color/images/icon$size.png";
        return '<link rel="icon" type="image/png"'
            ." id=\"icon{$size}Link\" sizes=\"{$size}x$size\""
            ." href=\"$base$path?".get_revision($path)."\" />";
    };

    return $create_link('16').$create_link('32').$create_link('48')
        .$create_link('64').$create_link('90').$create_link('120')
        .$create_link('128').$create_link('256').$create_link('512');

}
