<?php

namespace ErrorPage;

function create ($code, $text) {

    http_response_code($code);
    header('Content-Type: text/html; charset=UTF-8');

    echo
        '<!DOCTYPE html>'
        .'<html style="height: 100%">'
            .'<head>'
                ."<title>$code $text</title>"
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
                    ."$code $text"
                .'</div>'
            .'</body>'
        .'</html>';
    exit;

}
