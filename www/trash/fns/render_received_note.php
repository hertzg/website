<?php

function render_received_note ($note, &$title, &$icon) {

    $title = $note->title;

    if ($note->encrypt_in_listings) {
        include_once __DIR__.'/../../fns/encrypt_text.php';
        $title = encrypt_text($title);
        $icon = 'encrypted-note';
    } else {
        $icon = 'note';
    }

    $title = htmlspecialchars($title);

}
