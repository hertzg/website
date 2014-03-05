<?php

class Page {

    const HR = '<div class="hr"></div>';

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

    static function imageArrowLink ($title, $href, $iconName,
        array $options = array()) {
        $options['class'] = 'withArrow';
        return self::imageLink($title, $href, $iconName, $options);
    }

    static function imageArrowLinkWithDescription ($title, $description, $href,
        $iconName, array $options = array()) {
        $options['class'] = 'withArrow';
        return self::imageLinkWithDescription($title, $description, $href,
            $iconName, $options);
    }

    static function imageLink ($title, $href, $iconName, array $options = array()) {
        $content = "<div class=\"image_link-title\">$title</div>";
        include_once __DIR__.'/../fns/create_image_link.php';
        return create_image_link($content, $href, $iconName, $options);
    }

    static function imageLinkWithDescription ($title, $description, $href,
        $iconName, array $options = array()) {
        include_once __DIR__.'/../fns/create_title_and_description.php';
        $content = create_title_and_description($title, $description);
        include_once __DIR__.'/../fns/create_image_link.php';
        return create_image_link($content, $href, $iconName, $options);
    }

    static function info ($text) {
        return "<div class=\"page-info\">$text</div>";
    }

    static function optionlink ($title, $href, $selected) {
        $title .= $selected ? ' (Active)' : '';
        return "<a class=\"clickable link\" href=\"$href\">$title</a>";
    }

    static function text ($content) {
        return "<div class=\"page-text\">$content</div>";
    }

    static function textInfo ($content) {
        return "<div class=\"page-text-info\">$content</div>";
    }

    static function warnings ($errors) {
        $html = '';
        if ($errors) {
            $html = '<ul class="warnings">';
            foreach ($errors as $error) {
                $html .= "<li><span class=\"bullet\"></span>$error</li>";
            }
            $html .=
                '</ul>'
                .'<div class="warnings-hr"></div>';
        }
        return $html;
    }

}

include_once __DIR__.'/../lib/revisions.php';
