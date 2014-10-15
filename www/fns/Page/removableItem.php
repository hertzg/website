<?php

namespace Page;

function removableItem ($text, $removeHref, $icon) {
    return
        '<div class="removableItem">'
            ."<div class=\"removableItem-icon icon $icon\"></div>"
            ."<div class=\"removableItem-text\">$text</div>"
            ."<a class=\"clickable rightButton\" href=\"$removeHref\">"
                .'<span class="rightButton-icon icon no"></span>'
            .'</a>'
        .'</div>';
}
