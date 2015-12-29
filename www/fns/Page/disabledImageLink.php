<?php

namespace Page;

function disabledImageLink ($title, $iconName) {
    return
        "<div class=\"clickable link image_link\">"
            .'<div class="image_link-icon">'
                ."<div class=\"icon $iconName\"></div>"
            .'</div>'
            ."<div class=\"image_link-content colorText grey\">$title</div>"
        .'</div>';
}
