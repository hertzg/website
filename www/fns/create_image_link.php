<?php

function create_image_link ($content, $href, $iconName, array $options = []) {

    if (array_key_exists('id', $options)) {
        $idAttribute = " id=\"$options[id]\"";
        $nameLink = "<a name=\"$options[id]\"></a>";
    } else {
        $idAttribute = $nameLink = '';
    }

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
        $nameLink
        ."<a class=\"clickable link image_link$additionalClass\""
        ." href=\"$href\"$idAttribute$targetAttribute>"
            .'<div class="image_link-icon">'
                ."<div class=\"icon $iconName\"></div>"
            .'</div>'
            ."<div class=\"image_link-content\">$content</div>"
        .'</a>';

}
