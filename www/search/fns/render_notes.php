<?php

function render_notes ($notes, &$items, $regex, $encodedKeyword) {
    $fnsDir = __DIR__.'/../../fns';
    include_once "$fnsDir/create_note_link.php";
    foreach ($notes as $note) {

        $encrypt = $note->encrypt;

        $text = $note->text;
        if ($encrypt) {
            include_once "$fnsDir/encrypt_text.php";
            $title = htmlspecialchars(encrypt_text($text));
        } else {
            $escapedText = htmlspecialchars($text);
            $title = preg_replace($regex, '<mark>$0</mark>', $escapedText);
        }

        $query = "?id=$note->id&amp;keyword=$encodedKeyword";
        $href = "../notes/view/$query";
        $items[] = create_note_link($title, $note->tags, $encrypt, $href);

    }
}
