<?php

function echo_html ($title, $head, $body,
    $theme_color, $theme_brightness, $base) {

    header('Cache-Control: private');
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
                ." href=\"$theme_images/icon16.png?1\" />"
                .'<link rel="icon" type="image/png" sizes="32x32"'
                ." href=\"$theme_images/icon32.png?1\" />"
                .'<link rel="icon" type="image/png" sizes="48x48"'
                ." href=\"$theme_images/icon48.png\" />"
                .'<link rel="icon" type="image/png" sizes="60x60"'
                ." href=\"$theme_images/icon60.png\" />"
                .'<link rel="icon" type="image/png" sizes="64x64"'
                ." href=\"$theme_images/icon64.png\" />"
                .'<link rel="icon" type="image/png" sizes="84x84"'
                ." href=\"$theme_images/icon84.png\" />"
                .'<link rel="icon" type="image/png" sizes="90x90"'
                ." href=\"$theme_images/icon90.png\" />"
                .'<link rel="icon" type="image/png" sizes="120x120"'
                ." href=\"$theme_images/icon120.png\" />"
                .'<link rel="icon" type="image/png" sizes="126x126"'
                ." href=\"$theme_images/icon126.png\" />"
                .'<link rel="icon" type="image/png" sizes="128x128"'
                ." href=\"$theme_images/icon128.png\" />"
                .'<link rel="icon" type="image/png" sizes="142x142"'
                ." href=\"$theme_images/icon142.png\" />"
                .'<link rel="icon" type="image/png" sizes="189x189"'
                ." href=\"$theme_images/icon189.png\" />"
                .'<link rel="icon" type="image/png" sizes="256x256"'
                ." href=\"$theme_images/icon256.png\" />"
                .'<link rel="icon" type="image/png" sizes="512x512"'
                ." href=\"$theme_images/icon512.png\" />"
                .'<meta http-equiv="Content-Type"'
                .' content="text/html; charset=UTF-8" />'
                .'<meta name="viewport"'
                .' content="width=device-width, user-scalable=no" />'
                .compressed_css_link('common', $base)
                .compressed_css_link('iconsets', $base)
                .'<link rel="stylesheet" type="text/css"'
                ." href=\"{$base}theme/color/$theme_color/common.css?25\" />"
                .'<link rel="stylesheet" type="text/css"'
                ." href=\"{$base}theme/brightness/$theme_brightness/common.css?3\" />"
                .$head
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
