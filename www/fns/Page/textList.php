<?php

namespace Page;

function textList (array $texts, $class) {
    $html =
        "<div class=\"textList $class\">"
            .'<ul>';
    foreach ($texts as $text) {
        $html .= "<li><span class=\"bullet\"></span>$text</li>";
    }
    $html .=
            '</ul>'
        .'</div>';
    return $html;
}
