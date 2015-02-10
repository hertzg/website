<?php

function create_place_link ($latitude, $longitude,
    $name, $tags, $href, $options = []) {

    $icon = 'place';

    $title = "$latitude $longitude";
    $descriptionItems = [];
    if ($name !== '') {
        $descriptionItems[] = $title;
        $title = $name;
    }
    if ($tags !== '') {
        $descriptionItems[] = 'Tags: '.htmlspecialchars($tags);
    }

    if ($descriptionItems) {
        $description = join(' &middot; ', $descriptionItems);
        include_once __DIR__.'/Page/imageArrowLinkWithDescription.php';
        return Page\imageArrowLinkWithDescription($title,
            $description, $href, $icon, $options);
    }

    include_once __DIR__.'/Page/imageArrowLink.php';
    return Page\imageArrowLink($title, $href, $icon, $options);

}
