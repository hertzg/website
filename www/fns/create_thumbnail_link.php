<?php

function create_thumbnail_link ($content, $href, $iconName, $options = []) {

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
        ."<a class=\"clickable link thumbnail_link$additionalClass\""
        ." href=\"$href\"$idAttribute$targetAttribute>"
            .'<span class="thumbnail_link-icon">'
                ."<span class=\"icon $iconName\"></span>"
            .'</span>'
            ."<span class=\"thumbnail_link-content\">$content</span>"
        .'</a>';

}