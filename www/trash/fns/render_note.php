<?php

function render_note ($note, $description, $href, &$items) {

    $text = $note->text;

    if ($note->encrypt) {
        include_once __DIR__.'/../../fns/encrypt_text.php';
        $text = encrypt_text($text);
        $icon = 'encrypted-note';
    } else {
        $icon = 'note';
    }

    $title = htmlspecialchars($text);

    $items[] = Page\imageArrowLinkWithDescription(
        $title, $description, $href, $icon);

}
