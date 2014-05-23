<?php

namespace Page;

function textList (array $texts, $class) {
    $html =
        "<div class=\"textList $class\">"
            .'<ul>';
    if (count($texts) == 1) {
        $html .= "<li>$texts[0]</li>";
    } else {
        foreach ($texts as $text) {
            $html .= "<li><span class=\"bullet\"></span>$text</li>";
        }
    }
    $html .=
            '</ul>'
        .'</div>';
    return $html;
}
