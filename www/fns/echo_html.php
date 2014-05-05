<?php

function echo_html ($title, $head, $body, $theme, $base) {

    include_once __DIR__.'/get_revision.php';

    $revision = get_revision('common.compressed.css');
    $commonCss = "{$base}common.compressed.css?$revision";

    $revision = get_revision('icons.compressed.css');
    $iconsCss = "{$base}icons.compressed.css?$revision";

    header('Content-Type: text/html; charset=UTF-8');

    echo
        '<!DOCTYPE html>'
        .'<html>'
            .'<head>'
                ."<title>$title</title>"
                .'<link rel="icon" type="image/png"'
                ." href=\"{$base}zvini-icons/16.png\" />"
                .'<link rel="icon" type="image/png" sizes="32x32"'
                ." href=\"{$base}zvini-icons/32.png\" />"
                .'<meta http-equiv="Content-Type"'
                .' content="text/html; charset=UTF-8" />'
                .'<meta name="viewport"'
                .' content="width=device-width, user-scalable=no" />'
                ."<link rel=\"stylesheet\" type=\"text/css\" href=\"$commonCss\" />"
                ."<link rel=\"stylesheet\" type=\"text/css\" href=\"$iconsCss\" />"
                .'<link rel="stylesheet" type="text/css"'
                ." href=\"{$base}themes/$theme/common.css?12\" />"
                .$head
            .'</head>'
            ."<body>$body</body>"
        .'</html>';

}
