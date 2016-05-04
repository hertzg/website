<?php

namespace Page;

function panel ($title, $content, $newItemButton = '') {
    return
        '<div class="zeroHeight"><br class="zeroHeight" /></div>'
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
