<?php

namespace Page;

function imageLink ($content, $href, $iconName, $options = []) {

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
    if (array_key_exists('localNavigation', $options)) {
        $additionalClass .= ' localNavigation-link';
    }

    if (array_key_exists('image', $options)) {
        $contentAdditionalClass = ' withImage';
        $imageElement =
            '<span class="image_link-image"'
            ." style=\"background-image: url($options[image])\">"
            .'</span>';
    } else {
        $imageElement = '';
        $contentAdditionalClass = '';
    }

    return
        $nameLink
        ."<a class=\"clickable link image_link$additionalClass\""
        ." href=\"$href\"$idAttribute$targetAttribute>"
            .'<span class="image_link-icon">'
                ."<span class=\"icon $iconName\"></span>"
                .$imageElement
            .'</span>'
            ."<span class=\"image_link-content$contentAdditionalClass\">"
                .$content
            .'</span>'
        .'</a>';

}
