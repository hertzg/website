<?php

function create_image_link ($content, $href, $iconName, $target = null) {
    return
        "<a class=\"clickable link imageLink\" href=\"$href\""
        .($target === null ? '' : " target=\"$target\"").'>'
            .'<div class="imageLink-icon">'
                ."<div class=\"icon $iconName\"></div>"
            .'</div>'
            ."<div class=\"imageLink-content\">$content</div>"
        .'</a>';
}
