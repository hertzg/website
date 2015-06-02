<?php

namespace Page;

function removableTextItem ($text, $removeHref, $icon) {
    return
        '<div class="removableTextItem">'
            ."<div class=\"removableTextItem-icon icon $icon\"></div>"
            ."<div class=\"removableTextItem-text\">$text</div>"
            ."<a href=\"$removeHref\""
            .' class="clickable removableTextItem-removeButton">'
                .'<span class="removableTextItem-removeButton-icon icon trash-bin">'
                .'</span>'
            .'</a>'
        .'</div>';
}
