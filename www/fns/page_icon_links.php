<?php

function page_icon_links ($theme_color, $base = '') {

    include_once __DIR__.'/get_revision.php';
    $get_icon_href = function ($size) use ($base, $theme_color) {
        $href = "theme/color/$theme_color/images/icon$size.png";
        return "$base$href?".get_revision($href);
    };

    return '<link id="icon16Link" rel="icon" type="image/png"'
        .' href="'.$get_icon_href('16').'" sizes="16x16" />'
        .'<link id="icon32Link" rel="icon" type="image/png"'
        .' href="'.$get_icon_href('32').'" sizes="32x32" />'
        .'<link id="icon48Link" rel="icon" type="image/png"'
        .' href="'.$get_icon_href('48').'" sizes="48x48" />'
        .'<link id="icon64Link" rel="icon" type="image/png"'
        .' href="'.$get_icon_href('64').'" sizes="64x64" />'
        .'<link id="icon90Link" rel="icon" type="image/png"'
        .' href="'.$get_icon_href('90').'" sizes="90x90" />'
        .'<link id="icon120Link" rel="icon" type="image/png"'
        .' href="'.$get_icon_href('120').'" sizes="120x120" />'
        .'<link id="icon128Link" rel="icon" type="image/png"'
        .' href="'.$get_icon_href('128').'" sizes="128x128" />'
        .'<link id="icon256Link" rel="icon" type="image/png"'
        .' href="'.$get_icon_href('256').'" sizes="256x256" />'
        .'<link id="icon512Link" rel="icon" type="image/png"'
        .' href="'.$get_icon_href('512').'" sizes="512x512" />';
}
