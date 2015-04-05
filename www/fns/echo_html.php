<?php

function echo_html ($title, $head, $body, $theme, $base) {

    header_remove('Expires');
    header_remove('Pragma');
    header_remove('X-Powered-By');
    header('Cache-Control: private');
    header('Content-Type: text/html; charset=UTF-8');

    include_once __DIR__.'/compressed_css_link.php';
    include_once __DIR__.'/compressed_js_script.php';
    echo
        '<!DOCTYPE html>'
        .'<html>'
            .'<head>'
                ."<title>$title</title>"
                .'<link rel="icon" type="image/png"'
                ." href=\"{$base}themes/$theme/images/icon16.png?1\" />"
                .'<link rel="icon" type="image/png" sizes="32x32"'
                ." href=\"{$base}themes/$theme/images/icon32.png?1\" />"
                .'<link rel="icon" type="image/png" sizes="48x48"'
                ." href=\"{$base}zvini-icons/48.png\" />"
                .'<link rel="icon" type="image/png" sizes="60x60"'
                ." href=\"{$base}zvini-icons/60.png\" />"
                .'<link rel="icon" type="image/png" sizes="64x64"'
                ." href=\"{$base}zvini-icons/64.png\" />"
                .'<link rel="icon" type="image/png" sizes="84x84"'
                ." href=\"{$base}zvini-icons/84.png\" />"
                .'<link rel="icon" type="image/png" sizes="90x90"'
                ." href=\"{$base}zvini-icons/90.png\" />"
                .'<link rel="icon" type="image/png" sizes="120x120"'
                ." href=\"{$base}zvini-icons/120.png\" />"
                .'<link rel="icon" type="image/png" sizes="126x126"'
                ." href=\"{$base}zvini-icons/126.png\" />"
                .'<link rel="icon" type="image/png" sizes="128x128"'
                ." href=\"{$base}zvini-icons/128.png\" />"
                .'<link rel="icon" type="image/png" sizes="142x142"'
                ." href=\"{$base}zvini-icons/142.png\" />"
                .'<link rel="icon" type="image/png" sizes="189x189"'
                ." href=\"{$base}zvini-icons/189.png\" />"
                .'<link rel="icon" type="image/png" sizes="256x256"'
                ." href=\"{$base}zvini-icons/256.png\" />"
                .'<link rel="icon" type="image/png" sizes="512x512"'
                ." href=\"{$base}zvini-icons/512.png\" />"
                .'<meta http-equiv="Content-Type"'
                .' content="text/html; charset=UTF-8" />'
                .'<meta name="viewport"'
                .' content="width=device-width, user-scalable=no" />'
                .compressed_css_link('common', $base)
                .compressed_css_link('icons', $base)
                .'<link rel="stylesheet" type="text/css"'
                ." href=\"{$base}themes/$theme/common.css?17\" />"
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
