<?php

function create_place_link ($latitude,
    $longitude, $title, $tags, $href, $options = []) {

    if ($title === '') $title = "$latitude $longitude";

    $icon = 'place';

    if ($tags === '') {
        include_once __DIR__.'/Page/imageArrowLink.php';
        return Page\imageArrowLink($title, $href, $icon, $options);
    }

    include_once __DIR__.'/Page/imageArrowLinkWithDescription.php';
    return Page\imageArrowLinkWithDescription($title,
        'Tags: '.htmlspecialchars($tags), $href, $icon, $options);

}
