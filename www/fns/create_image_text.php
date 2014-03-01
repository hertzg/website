<?php

function create_image_text ($content, $iconName) {
    return
        '<div class="imageText">'
            .'<div class="imageText-icon">'
                ."<span class=\"icon $iconName\"></span>"
            .'</div>'
            ."<div class=\"imageText-text\">$content</div>"
        .'</div>';
}
