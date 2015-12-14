<?php

namespace Page;

function removableItem ($text, $removeHref, $icon) {
    return
        '<div class="removableItem">'
            ."<div class=\"removableItem-icon icon $icon\"></div>"
            ."<div class=\"removableItem-text\">$text</div>"
            ."<a href=\"$removeHref\""
            .' class="clickable removableItem-removeButton">'
                .'<span class="removableItem-removeButton-icon icon trash-bin">'
                .'</span>'
            .'</a>'
        .'</div>';
}
