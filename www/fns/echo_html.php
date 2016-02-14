<?php

function echo_html ($title, $head, $body,
    $theme_color, $theme_brightness, $base, $scripts = '') {

    header('Cache-Control: private, max-age=0');
    header('Content-Type: text/html; charset=UTF-8');

    include_once __DIR__.'/compressed_css_link.php';
    include_once __DIR__.'/compressed_js_script.php';
    include_once __DIR__.'/page_icon_links.php';
    include_once __DIR__.'/page_theme_links.php';
    include_once __DIR__.'/vars_script.php';
    echo
        '<!DOCTYPE html>'
        .'<html>'
            .'<head>'
                ."<title>$title</title>"
                .'<meta http-equiv="Content-Type"'
                .' content="text/html; charset=UTF-8" />'
                .'<meta name="viewport"'
                .' content="width=device-width, user-scalable=no" />'
                .page_icon_links($theme_color, $base)
                .compressed_css_link('common', $base, 'localNavigation-leave')
                .compressed_css_link('iconsets', $base, 'localNavigation-leave')
                .$head
                .page_theme_links($theme_color, $theme_brightness, $base)
            .'</head>'
            .'<body>'
                .$body
                .vars_script($base, $theme_color, $theme_brightness)
                .compressed_js_script('unloadProgress', $base)
                .compressed_js_script('localNavigation', $base)
                .compressed_js_script('ui', $base)
                .$scripts
            .'</body>'
        .'</html>';

    exit;

}
