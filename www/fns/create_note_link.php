<?php

function create_note_link ($theme_brightness, $title, $num_tags,
    $tags_json, $encrypt, $href, $options = [], $paint = false) {

    $icon = $encrypt ? 'encrypted-note' : 'note';
    $text_luminance = $theme_brightness === 'light' ? 10 : 90;

    if ($num_tags) {

        include_once __DIR__.'/ColorTag/render.php';
        $description = ColorTag\render(json_decode($tags_json), $text_luminance, $paint);

        include_once __DIR__.'/Page/imageArrowLinkWithDescription.php';
        return Page\imageArrowLinkWithDescription(
            $title, $description, $href, $icon, $options);

    }

    include_once __DIR__.'/Page/imageArrowLink.php';
    return Page\imageArrowLink($title, $href, $icon, $options);

}
