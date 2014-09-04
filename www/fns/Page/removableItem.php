<?php

namespace Page;

function removableItem ($text, $removeHref, $icon) {
    return
        '<div class="removableItem">'
            ."<div class=\"icon $icon\"></div>"
            ."<div class=\"removableItem-text\">$text</div>"
            ."<a class=\"clickable rightButton\" href=\"$removeHref\">"
                .'<span class="icon no"></span>'
            .'</a>'
        .'</div>';
}
