<?php

function echo_html ($title, $content) {
    header('Content-Type: text/html; charset=UTF-8');
    echo '<!DOCTYPE html>'
        .'<html>'
            .'<head>'
                ."<title>$title</title>"
                .'<meta http-equiv="Content-Type"'
                .' content="text/html; charset=UTF-8" />'
                .'<meta name="viewport"'
                .' content="width=device-width, user-scalable=no" />'
                .'<link rel="icon" type="image/png" href="../icons/16.png?1" />'
                .'<link rel="icon" type="image/png"'
                .' href="../icons/32.png?1" sizes="32x32" />'
                .'<link rel="stylesheet" type="text/css"'
                .' href="../css/compressed.css?12" />'
            .'</head>'
            .'<body>'
                .'<div class="backgroundGradient">'
                    .'<div class="backgroundGradient-gradient"></div>'
                .'</div>'
                .'<div class="page">'
                    .'<div class="page-aligner"></div>'
                    ."<div class=\"page-content\">$content</div>"
                .'</div>'
            .'</body>'
        .'</html>';
}
