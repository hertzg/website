<?php

class Page {

    const HR = '<div class="hr"></div>';

    public $base = '';
    public $head = '';
    public $title = 'Zvini';
    public $hideSignOutLink = false;
    public $theme;

    function __construct () {
        global $user;
        $this->theme = $user ? $user->theme : 'orange';
    }

    function echoHtml ($body) {

        $theme = $this->theme;
        $base = $this->base;

        header('Content-Type: text/html; charset=UTF-8');

        echo
            '<!DOCTYPE html>'
            .'<html>'
                .'<head>'
                    ."<title>$this->title</title>"
                    ."<link rel=\"icon\" type=\"image/png\" href=\"{$base}images/favicon.png\" />"
                    .'<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />'
                    .'<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1" />'
                    ."<link rel=\"stylesheet\" type=\"text/css\" href=\"{$base}common.css?25\" />"
                    ."<link rel=\"stylesheet\" type=\"text/css\" href=\"{$base}icons.css?3\" />"
                    ."<link rel=\"stylesheet\" type=\"text/css\" href=\"{$base}themes/$theme/common.css?8\" />"
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
                $html .= "<li>$error</li>";
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
                        ."<img src=\"{$base}images/zvini.png\" alt=\"Zvini\" width=\"51\" height=\"24\" />"
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

    static function imageItem ($content, $href, $iconName) {
        return
            "<a class=\"clickable link imageLink\" href=\"$href\">"
                .'<div class="imageLink-icon">'.self::icon($iconName).'</div>'
                ."<div class=\"imageLink-content\">$content</div>"
            .'</a>';
    }

    static function imageLink ($title, $href, $iconName) {
        $content = "<div class=\"imageLink-title\">$title</div>";
        return self::imageItem($content, $href, $iconName);
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
                ."<div>$title</div>"
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
                $html .= "<li>$error</li>";
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
                $html .= "<li>$error</li>";
            }
            $html .=
                '</ul>'
                .'<div class="warnings-hr"></div>';
        }
        return $html;
    }

}

$page = new Page;
