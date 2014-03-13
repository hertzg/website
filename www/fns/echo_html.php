<?php

function echo_html ($title, $head, $body, $theme, $base) {

    include_once __DIR__.'/get_revision.php';
    $commonCssRevision = get_revision('common.compressed.css');

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
                .'<meta name="viewport" content="width=device-width" />'
                .'<link rel="stylesheet" type="text/css"'
                ." href=\"{$base}common.compressed.css?$commonCssRevision\" />"
                .'<link rel="stylesheet" type="text/css"'
                ." href=\"{$base}icons.css?15\" />"
                .'<link rel="stylesheet" type="text/css"'
                ." href=\"{$base}themes/$theme/common.css?12\" />"
                .$head
            .'</head>'
            ."<body>$body</body>"
        .'</html>';

}
