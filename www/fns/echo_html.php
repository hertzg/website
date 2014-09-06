<?php

function echo_html ($title, $head, $body, $theme, $base) {

    include_once __DIR__.'/get_revision.php';
    $commonCssRevision = get_revision('common.compressed.css');
    $iconsCssRevision = get_revision('icons.compressed.css');

    header_remove('Expires');
    header_remove('Pragma');
    header_remove('X-Powered-By');
    header('Cache-Control: private');
    header('Content-Type: text/html; charset=UTF-8');

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
                .'<link rel="stylesheet" type="text/css"'
                ." href=\"{$base}common.compressed.css?$commonCssRevision\" />"
                .'<link rel="stylesheet" type="text/css"'
                ." href=\"{$base}icons.compressed.css?$iconsCssRevision\" />"
                .'<link rel="stylesheet" type="text/css"'
                ." href=\"{$base}themes/$theme/common.css?14\" />"
                .$head
            .'</head>'
            ."<body>$body</body>"
        .'</html>';

}
