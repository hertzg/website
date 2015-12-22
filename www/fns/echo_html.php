<?php

function echo_html ($title, $head, $body,
    $theme_color, $theme_brightness, $base) {

    header('Cache-Control: private, max-age=0');
    header('Content-Type: text/html; charset=UTF-8');

    include_once __DIR__.'/compressed_css_link.php';
    include_once __DIR__.'/compressed_js_script.php';
    include_once __DIR__.'/page_icon_links.php';
    include_once __DIR__.'/page_theme_links.php';
    echo
        '<!DOCTYPE html>'
        .'<html>'
            .'<head>'
                ."<title>$title</title>"
                .page_icon_links($theme_color, $base)
                .'<meta http-equiv="Content-Type"'
                .' content="text/html; charset=UTF-8" />'
                .'<meta name="viewport"'
                .' content="width=device-width, user-scalable=no" />'
                .compressed_css_link('common', $base)
                .compressed_css_link('iconsets', $base)
                .$head
                .page_theme_links($theme_color, $theme_brightness, $base)
            .'</head>'
            .'<body>'
                .'<script type="text/javascript">'
                    .'var base = '.json_encode($base)
                .'</script>'
                .compressed_js_script('unloadProgress', $base)
                .$body
            .'</body>'
        .'</html>';

    exit;

}
