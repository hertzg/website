<?php

function create_panel ($title, $content) {
    return
        '<div class="panel">'
            ."<div class=\"title\">$title</div>"
            ."<div class=\"content\">$content</div>"
        .'</div>';
}
