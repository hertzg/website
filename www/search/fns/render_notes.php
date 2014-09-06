<?php

function render_notes (array $notes,
    array &$items, $regex, $encodedKeyword) {

    include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
    foreach ($notes as $note) {

        $text = $note->text;
        if ($note->encrypt) {
            include_once __DIR__.'/../../fns/encrypt_text.php';
            $title = htmlspecialchars(encrypt_text($text));
            $icon = 'encrypted-note';
        } else {
            $escapedText = htmlspecialchars($text);
            $title = preg_replace($regex, '<mark>$0</mark>', $escapedText);
            $icon = 'note';
        }

        $query = "?id=$note->id_notes&amp;keyword=$encodedKeyword";
        $href = "../notes/view/$query";
        $items[] = Page\imageArrowLink($title, $href, $icon);

    }

}
