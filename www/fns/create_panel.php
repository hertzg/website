<?php

function create_panel ($title, $content) {
    return
        '<div class="panel">'
            ."<div class=\"panel-title\">$title</div>"
            ."<div class=\"panel-content\">$content</div>"
        .'</div>';
}
