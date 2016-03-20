<?php

namespace Page;

function panel ($title, $content, $newItemButton = '') {
    return
        '<br class="zeroHeight" />'
        .'<div class="panel">'
            .'<div class="panel-title">'
                .'<div class="panel-title-text">'
                    ."$title<span class=\"zeroSize\">:</span>"
                .'</div>'
                .$newItemButton
            .'</div>'
            ."<div class=\"panel-content\">$content</div>"
        .'</div>';
}
