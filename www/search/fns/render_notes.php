<?php

function render_notes (array $notes, array &$items, $regex) {
    include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
    foreach ($notes as $note) {

        $text = $note->text;
        if ($note->encrypt) {
            include_once __DIR__.'/../../fns/encrypt_text.php';
            $title = htmlspecialchars(encrypt_text($text));
        } else {
            $escapedText = htmlspecialchars($text);
            $title = preg_replace($regex, '<mark>$0</mark>', $escapedText);
        }

        $href = "../notes/view/?id=$note->id_notes";
        $items[] = Page\imageArrowLink($title, $href, 'note');
    }
}
