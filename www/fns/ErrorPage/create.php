<?php

namespace ErrorPage;

function create ($code, $text, $description) {

    include_once __DIR__.'/../SiteBase/get.php';
    $siteBase = \SiteBase\get();

    http_response_code($code);
    header('Content-Type: text/html; charset=UTF-8');

    echo
        '<!DOCTYPE html>'
        .'<html style="height: 100%">'
            .'<head>'
                ."<title>$code $text</title>"
                .'<meta http-equiv="Content-Type"'
                .' content="text/html; charset=UTF-8" />'
                .'<meta name="viewport"'
                .' content="width=device-width, user-scalable=no" />'
                .'<style>'
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
                    .'body > * {'
                        .'display: inline-block;'
                        .'vertical-align: middle;'
                    .'}'
                    .'a {'
                        .'color: #f70;'
                    .'}'
                    .'em {'
                        .'border-bottom: 1px dotted;'
                        .'word-wrap: break-word;'
                    .'}'
                .'</style>'
            .'</head>'
            .'<body>'
                .'<div style="height: 100%"></div>'
                .'<div style="padding: 8px; white-space: normal; max-width: 100%">'
                    .'<div style="font-weight: bold; font-size: 22px">'
                        ."$code $text"
                    .'</div>'
                    .'<br />'
                    ."<div>$description</div>"
                    .'<br />'
                    .'<div>'
                        ."<a href=\"$siteBase\">Return to Zvini</a>"
                    .'</div>'
                .'</div>'
            .'</body>'
        .'</html>';
    exit;

}
