<?php

function echo_html ($title, $content, $head = '') {
    header('Content-Type: text/html; charset=UTF-8');
    echo '<!DOCTYPE html>'
        .'<html>'
            .'<head>'
                ."<title>$title</title>"
                .'<meta http-equiv="Content-Type"'
                .' content="text/html; charset=UTF-8" />'
                .'<link rel="icon" type="image/png" href="../icons/16.png" />'
                .'<link rel="icon" type="image/png"
                href="../icons/32.png" sizes="32x32" />'
                .'<link rel="stylesheet" type="text/css" href="../common.css" />'
                .$head
            .'</head>'
            .'<body>'
                .'<div class="page">'
                    .'<div class="page-aligner"></div>'
                    ."<div class=\"page-content\">$content</div>"
                .'</div>'
            .'</body>'
        .'</html>';
}
