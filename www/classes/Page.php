<?php

class Page {

    public $base = '';
    public $head = '';
    public $title = 'Zvini';
    public $hideSignOutLink = false;
    public $theme;

    function echoHtml ($body) {

        global $revisions;

        $theme = $this->theme;
        $base = $this->base;

        header('Content-Type: text/html; charset=UTF-8');

        echo
            '<!DOCTYPE html>'
            .'<html>'
                .'<head>'
                    ."<title>$this->title</title>"
                    .'<link rel="icon" type="image/png"'
                    ." href=\"{$base}zvini-icons/16.png\" />"
                    .'<link rel="icon" type="image/png" sizes="32x32"'
                    ." href=\"{$base}zvini-icons/32.png\" />"
                    .'<meta http-equiv="Content-Type"'
                    .' content="text/html; charset=UTF-8" />'
                    .'<meta name="viewport" content="width=device-width" />'
                    .'<link rel="stylesheet" type="text/css"'
                    ." href=\"{$base}common.css?".$revisions['common.css'].'" />'
                    .'<link rel="stylesheet" type="text/css"'
                    ." href=\"{$base}icons.css?14\" />"
                    .'<link rel="stylesheet" type="text/css"'
                    ." href=\"{$base}themes/$theme/common.css?12\" />"
                    .$this->head
                .'</head>'
                ."<body>$body</body>"
            .'</html>';

    }

    function finish ($content) {
        $base = $this->base;
        $this->echoHtml(
            '<div id="tbar">'
                .'<div style="position: relative">'
                    .'<a class="topLink" href="'.($base ? $base : './').'">'
                        ."<img src=\"{$base}themes/$this->theme/images/zvini.png?2\""
                        .' alt="Zvini" width="68" height="32"'
                        .' style="vertical-align: top; margin: -4px" />'
                    .'</a>'
                    .($this->hideSignOutLink ? '' : 
                    '<div style="position: absolute; top: 0; right: 0">'
                        .'<a class="topLink"'
                        ." href=\"{$base}submit-signout.php\">"
                            .'Sign Out'
                        .'</a>'
                    .'</div>')
                .'</div>'
            .'</div>'
            .$content
            .'<div id="bbar">'
                .'&copy; 2009-'.date('Y').' Zvini'
            .'</div>'
        );
    }

}

include_once __DIR__.'/../lib/revisions.php';
