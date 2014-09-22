<?php

function echo_html ($title, $head, $body, $theme, $base) {

    header_remove('Expires');
    header_remove('Pragma');
    header_remove('X-Powered-By');
    header('Cache-Control: private');
    header('Content-Type: text/html; charset=UTF-8');

    include_once __DIR__.'/compressed_css_link.php';
    echo
        '<!DOCTYPE html>'
        .'<html>'
            .'<head>'
                ."<title>$title</title>"
                .'<link rel="icon" type="image/png"'
                ." href=\"{$base}themes/$theme/images/icon16.png\" />"
                .'<link rel="icon" type="image/png" sizes="32x32"'
                ." href=\"{$base}themes/$theme/images/icon32.png\" />"
                .'<meta http-equiv="Content-Type"'
                .' content="text/html; charset=UTF-8" />'
                .'<meta name="viewport"'
                .' content="width=device-width, user-scalable=no" />'
                .compressed_css_link('common', $base)
                .compressed_css_link('icons', $base)
                .'<link rel="stylesheet" type="text/css"'
                ." href=\"{$base}themes/$theme/common.css?15\" />"
                .$head
            .'</head>'
            ."<body>$body</body>"
        .'</html>';

}
