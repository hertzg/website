<?php

function create_panel ($title, $content) {
    return
        '<br class="zeroHeight" />'
        .'<div class="panel">'
            .'<div class="panel-title">'
                ."$title<span class=\"zeroSize\">:</span>"
            .'</div>'
            ."<div class=\"panel-content\">$content</div>"
        .'</div>';
}
