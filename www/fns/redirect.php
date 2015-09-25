<?php

function redirect ($url = './') {

    header("Location: $url");
    header('Cache-Control: private, max-age=0');
    header('Content-Type: text/html; charset=UTF-8');

    echo '<!DOCTYPE html>'
        .'<html>'
            .'<head>'
                .'<title>Document Moved</title>'
                .'<meta http-equiv="Content-Type"'
                .' content="text/html; charset=UTF-8" />'
                .'<meta name="viewport"'
                .' content="width=device-width, user-scalable=no" />'
                .'<style type="text/css">'
                    .'* {'
                        .'margin: 0;'
                        .'padding: 0;'
                        .'font: normal 16px/18px Arial, sans-serif;'
                        .'box-sizing: border-box;'
                        .'-moz-box-sizing: border-box;'
                    .'}'
                    .'html, body {'
                        .'height: 100%;'
                        .'white-space: nowrap;'
                        .'text-align: center;'
                        .'background: #444;'
                        .'color: #fff;'
                    .'}'
                    .'h1 {'
                        .'font-weight: bold;'
                        .'font-size: 22px;'
                    .'}'
                    .'.layout {'
                        .'display: inline-block;'
                        .'vertical-align: middle;'
                    .'}'
                    .'.layout.aligner {'
                        .'height: 100%;'
                    .'}'
                    .'.layout.content {'
                        .'padding: 8px;'
                        .'white-space: normal;'
                        .'max-width: 100%;'
                    .'}'
                    .'a {'
                        .'color: #f70;'
                    .'}'
                .'</style>'
            .'</head>'
            .'<body>'
                .'<div class="layout aligner"></div>'
                .'<div class="layout content">'
                    .'<h1>Document Moved</h1>'
                    .'<br />'
                    .'<div>'
                        .'The document has moved'
                        .' <a href="'.htmlspecialchars($url).'">here</a>.'
                    .'</div>'
                .'</div>'
            .'</body>'
        .'</html>';

    exit;

}
