<?php

function render_received_note ($note, $description, $href, $options, &$items) {

    $title = $note->title;

    if ($note->encrypt_in_listings) {
        include_once __DIR__.'/../../fns/encrypt_text.php';
        $title = encrypt_text($title);
        $icon = 'encrypted-note';
    } else {
        $icon = 'note';
    }

    $title = htmlspecialchars($title);

    $items[] = Page\imageArrowLinkWithDescription(
        $title, $description, $href, $icon, $options);

}
