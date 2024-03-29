<?php

namespace ErrorPage;

function create ($code, $text, $description, $send_headers = null) {

    include_once __DIR__.'/../SiteBase/get.php';
    $siteBase = \SiteBase\get();

    http_response_code($code);
    header('Cache-Control: private, max-age=0');
    header('Content-Type: text/html; charset=UTF-8');

    if ($send_headers !== null) $send_headers();

    if (array_key_exists('HTTP_REFERER', $_SERVER)) {
        $href = htmlspecialchars($_SERVER['HTTP_REFERER']);
        $returnBackLink = "<a href=\"$href\">Return Back</a> or ";
    } else {
        $returnBackLink = '';
    }

    echo
        '<!DOCTYPE html>'
        .'<html style="height: 100%">'
            .'<head>'
                ."<title>$code $text</title>"
                .'<meta http-equiv="Content-Type"'
                .' content="text/html; charset=UTF-8" />'
                .'<meta name="viewport"'
                .' content="width=device-width, user-scalable=no" />'
                .'<style type="text/css">'
                    .'* {'
                        .'margin: 0;'
                        .'padding: 0;'
                        .'font: inherit;'
                        .'box-sizing: border-box;'
                        .'-moz-box-sizing: border-box;'
                    .'}'
                    .'html, body {'
                        .'height: 100%;'
                        .'white-space: nowrap;'
                        .'text-align: center;'
                        .'background: #444;'
                        .'color: #fff;'
                        .'font: normal 16px/18px Arial, sans-serif;'
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
                        .'color: #f80;'
                    .'}'
                    .'a:focus {'
                        .'background-color: rgba(255, 136, 0, 0.2);'
                    .'}'
                    .'em {'
                        .'border-bottom: 1px dotted;'
                        .'word-wrap: break-word;'
                    .'}'
                .'</style>'
            .'</head>'
            .'<body>'
                .'<div class="layout aligner"></div>'
                .'<div class="layout content">'
                    ."<h1>$code $text</h1>"
                    .'<br />'
                    ."<div>$description</div>"
                    .'<br />'
                    .'<div>'
                        .$returnBackLink
                        ."<a href=\"$siteBase\">Return to Zvini</a>"
                    .'</div>'
                .'</div>'
            .'</body>'
        .'</html>';

    exit;

}
