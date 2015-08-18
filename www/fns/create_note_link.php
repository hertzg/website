<?php

function create_note_link ($title, $num_tags, $tags_json,
    $encrypt, $href, $options = [], $paint = false) {

    $icon = $encrypt ? 'encrypted-note' : 'note';

    if ($num_tags) {

        include_once __DIR__.'/ColorTag/render.php';
        $description = ColorTag\render(json_decode($tags_json), 10, $paint);

        include_once __DIR__.'/Page/imageArrowLinkWithDescription.php';
        return Page\imageArrowLinkWithDescription(
            $title, $description, $href, $icon, $options);

    }

    include_once __DIR__.'/Page/imageArrowLink.php';
    return Page\imageArrowLink($title, $href, $icon, $options);

}
