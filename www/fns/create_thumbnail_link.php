<?php

function create_thumbnail_link ($content, $href, $iconName, $options = []) {

    if (array_key_exists('id', $options)) {
        $idAttribute = " id=\"$options[id]\"";
        $nameLink = "<a name=\"$options[id]\"></a>";
    } else {
        $idAttribute = $nameLink = '';
    }

    if (array_key_exists('class', $options)) {
        $additionalClass = " $options[class]";
    } else {
        $additionalClass = '';
    }
    if (array_key_exists('localNavigation', $options)) {
        $additionalClass .= ' localNavigation-link';
    }

    return
        $nameLink
        ."<a class=\"clickable link thumbnail_link$additionalClass\""
        ." href=\"$href\"$idAttribute>"
            .'<span class="thumbnail_link-icon">'
                ."<span class=\"icon $iconName\"></span>"
            .'</span>'
            ."<span class=\"thumbnail_link-content\">$content</span>"
        .'</a>';

}
