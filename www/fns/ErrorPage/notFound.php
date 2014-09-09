<?php

namespace ErrorPage;

function notFound () {

    http_response_code(404);
    header('Content-Type: text/html; charset=UTF-8');

    echo
        '<!DOCTYPE html>'
        .'<html style="height: 100%">'
            .'<head>'
                .'<title>404 Not Found</title>'
                .'<meta http-equiv="Content-Type"'
                .' content="text/html; charset=UTF-8" />'
                .'<style>'
                    .'* {'
                        .'margin: 0;'
                        .'padding: 0;'
                        .'font: normal 16px/18px Arial, sans-serif;'
                    .'}'
                    .'html, body {'
                        .'height: 100%;'
                        .'white-space: nowrap;'
                        .'text-align: center;'
                        .'background: #444;'
                        .'color: #fff;'
                    .'}'
                    .'body > * {'
                        .'display: inline-block;'
                        .'vertical-align: middle;'
                    .'}'
                .'</style>'
            .'</head>'
            .'<body>'
                .'<div style="height: 100%"></div>'
                .'<div style="padding: 8px; white-space: normal">'
                    .'404 Not Found'
                .'</div>'
            .'</body>'
        .'</html>';

}
