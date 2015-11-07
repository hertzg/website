<?php

namespace Page;

function textList ($texts, $class) {
    $html =
        "<div class=\"textList $class\">"
            .'<ul class="textList-list">';
    if (count($texts) == 1) {
        $html .= "<li class=\"textList-list-item\">$texts[0]</li>";
    } else {
        foreach ($texts as $text) {
            $html .=
                '<li class="textList-list-item">'
                    ."<span class=\"textList-list-item-bullet $class\"></span>"
                    .$text
                .'</li>';
        }
    }
    $html .=
            '</ul>'
        .'</div>';
    return $html;
}
