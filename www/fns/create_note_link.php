<?php

function create_note_link ($title, $tags, $encrypt, $href, $options = []) {

    $icon = $encrypt ? 'encrypted-note' : 'note';

    if ($tags === '') {
        include_once __DIR__.'/Page/imageArrowLink.php';
        return Page\imageArrowLink($title, $href, $icon, $options);
    }

    $description = 'Tags: '.htmlspecialchars($tags);
    include_once __DIR__.'/Page/imageArrowLinkWithDescription.php';
    return Page\imageArrowLinkWithDescription(
        $title, $description, $href, $icon, $options);

}
