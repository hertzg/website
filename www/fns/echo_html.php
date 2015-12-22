<?php

function echo_html ($title, $head, $body,
    $theme_color, $theme_brightness, $base) {

    header('Cache-Control: private, max-age=0');
    header('Content-Type: text/html; charset=UTF-8');

    $theme_images = "{$base}theme/color/$theme_color/images";

    include_once __DIR__.'/compressed_css_link.php';
    include_once __DIR__.'/compressed_js_script.php';
    echo
        '<!DOCTYPE html>'
        .'<html>'
            .'<head>'
                ."<title>$title</title>"
                .'<link rel="icon" type="image/png"'
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
                ." href=\"$theme_images/icon512.png?1\" />"
                .'<meta http-equiv="Content-Type"'
                .' content="text/html; charset=UTF-8" />'
                .'<meta name="viewport"'
                .' content="width=device-width, user-scalable=no" />'
                .compressed_css_link('common', $base)
                .compressed_css_link('iconsets', $base)
                .$head
                .'<link rel="stylesheet" type="text/css"'
                ." href=\"{$base}theme/color/$theme_color/common.css?31\" />"
                .'<link rel="stylesheet" type="text/css"'
                ." href=\"{$base}theme/brightness/$theme_brightness/common.css?7\" />"
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
