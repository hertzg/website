<?php

function page_icon_links ($theme_color, $base = '') {

    include_once __DIR__.'/get_revision.php';
    $get_icon_href = function ($size) use ($base, $theme_color) {
        $href = "theme/color/$theme_color/images/icon$size.png";
        return "$base$href?".get_revision($href);
    };

    return '<link rel="icon" type="image/png"'
        .' href="'.$get_icon_href('16').'" />'
        .'<link rel="icon" type="image/png" sizes="32x32"'
        .' href="'.$get_icon_href('16').'" />'
        .'<link rel="icon" type="image/png" sizes="48x48"'
        .' href="'.$get_icon_href('16').'" />'
        .'<link rel="icon" type="image/png" sizes="64x64"'
        .' href="'.$get_icon_href('16').'" />'
        .'<link rel="icon" type="image/png" sizes="90x90"'
        .' href="'.$get_icon_href('16').'" />'
        .'<link rel="icon" type="image/png" sizes="120x120"'
        .' href="'.$get_icon_href('16').'" />'
        .'<link rel="icon" type="image/png" sizes="128x128"'
        .' href="'.$get_icon_href('16').'" />'
        .'<link rel="icon" type="image/png" sizes="256x256"'
        .' href="'.$get_icon_href('16').'" />'
        .'<link rel="icon" type="image/png" sizes="512x512"'
        .' href="'.$get_icon_href('16').'" />';
}
