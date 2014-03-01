<?php

function create_image_link ($content, $href, $iconName, array $options = array()) {

    if (array_key_exists('target', $options)) {
        $targetAttribute = " target=\"$options[target]\"";
    } else {
        $targetAttribute = '';
    }

    if (array_key_exists('class', $options)) {
        $additionalClass = " $options[class]";
    } else {
        $additionalClass = '';
    }

    return
        "<a class=\"clickable link image_link$additionalClass\""
        ." href=\"$href\"$targetAttribute>"
            .'<div class="image_link-icon">'
                ."<div class=\"icon $iconName\"></div>"
            .'</div>'
            ."<div class=\"image_link-content\">$content</div>"
        .'</a>';

}
