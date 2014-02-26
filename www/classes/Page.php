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
                    ."<link rel=\"icon\" type=\"image/png\" href=\"{$base}zvini-icons/16.png\" />"
                    ."<link rel=\"icon\" type=\"image/png\" href=\"{$base}zvini-icons/32.png\" sizes=\"32x32\" />"
                    .'<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />'
                    .'<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1" />'
                    ."<link rel=\"stylesheet\" type=\"text/css\" href=\"{$base}common.css?".$revisions['common.css'].'" />'
                    ."<link rel=\"stylesheet\" type=\"text/css\" href=\"{$base}icons.css?14\" />"
                    ."<link rel=\"stylesheet\" type=\"text/css\" href=\"{$base}themes/$theme/common.css?12\" />"
                    .$this->head
                .'</head>'
                ."<body>$body</body>"
            .'</html>';

    }

    static function errors ($errors) {
        $html = '';
        if ($errors) {
            $html = '<ul class="errors">';
            foreach ($errors as $error) {
                $html .= "<li><span class=\"bullet\"></span>$error</li>";
            }
            $html .=
                '</ul>'
                .'<div class="errors-hr"></div>';
        }
        return $html;
    }

    function finish ($content) {
        $base = $this->base;
        $this->echoHtml(
            '<div id="tbar">'
                .'<div style="position: relative">'
                    .'<a class="topLink" href="'.($base ? $base : './').'">'
                        ."<img src=\"{$base}themes/$this->theme/images/zvini.png?2\" alt=\"Zvini\""
                        .' width="68" height="32" style="vertical-align: top; margin: -4px" />'
                    .'</a>'
                    .($this->hideSignOutLink ? '' : 
                    '<div style="position: absolute; top: 0; right: 0">'
                        ."<a class=\"topLink\" href=\"{$base}submit-signout.php\">Sign Out</a>"
                    .'</div>')
                .'</div>'
            .'</div>'
            .$content
            .'<div id="bbar">'
                .'&copy; 2009-'.date('Y').' Zvini'
            .'</div>'
        );
    }

    static function icon ($name) {
        return "<div class=\"icon $name\"></div>";
    }

    static function imageItem ($content, $href, $iconName, $target = null) {
        return
            "<a class=\"clickable link imageLink\" href=\"$href\""
            .($target === null ? '' : " target=\"$target\"").'>'
                .'<div class="imageLink-icon">'.self::icon($iconName).'</div>'
                ."<div class=\"imageLink-content\">$content</div>"
            .'</a>';
    }

    static function imageLink ($title, $href, $iconName, $target = null) {
        $content = "<div class=\"imageLink-title\">$title</div>";
        return self::imageItem($content, $href, $iconName, $target);
    }

    static function disabledImageLink ($title, $iconName) {
        return
            "<div class=\"clickable link imageLink\">"
                .'<div class="imageLink-icon">'.self::icon($iconName).'</div>'
                .'<div class="imageLink-content">'
                    ."<div class=\"imageLink-title disabled\">$title</div>"
                .'</div>'
            .'</div>';
    }

    static function imageLinkWithDescription ($title, $description, $href, $iconName) {
        $title =
            '<div style="line-height: 18px; padding: 6px 0;">'
                ."<div class=\"linkTitle\">$title</div>"
                ."<div class=\"linkDescription\">$description</div>"
            .'</div>';
        return Page::imageItem($title, $href, $iconName);
    }

    static function imageText ($content, $iconName) {
        return
            '<div class="imageText">'
                .'<div class="imageText-icon">'
                    .self::icon($iconName)
                .'</div>'
                .'<div class="imageText-text">'
                    .$content
                .'</div>'
            .'</div>';
    }

    static function info ($text) {
        return "<div class=\"page-info\">$text</div>";
    }

    static function link ($title, $href) {
        return "<a class=\"clickable link\" href=\"$href\">$title</a>";
    }

    static function messages ($errors) {
        $html = '';
        if ($errors) {
            $html = '<ul class="messages">';
            foreach ($errors as $error) {
                $html .= "<li><span class=\"bullet\"></span>$error</li>";
            }
            $html .=
                '</ul>'
                .'<div class="messages-hr"></div>';
        }
        return $html;
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
