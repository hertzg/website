<?php

function create_place_link ($latitude, $longitude,
    $title, $tags_json, $href, $options = [], $paint = false) {

    if ($title === '') $title = "$latitude $longitude";

    $icon = 'place';

    $tags = json_decode($tags_json);
    if ($tags) {

        include_once __DIR__.'/ColorTag/render.php';
        $description = ColorTag\render($tags, $paint);

        include_once __DIR__.'/Page/imageArrowLinkWithDescription.php';
        return Page\imageArrowLinkWithDescription($title,
            $description, $href, $icon, $options);

    }

    include_once __DIR__.'/Page/imageArrowLink.php';
    return Page\imageArrowLink($title, $href, $icon, $options);

}
