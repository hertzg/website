<?php

function render_notes ($notes, &$items, $regex, $encodedKeyword) {
    $fnsDir = __DIR__.'/../../fns';
    include_once "$fnsDir/Page/imageArrowLink.php";
    foreach ($notes as $note) {

        $text = $note->text;
        if ($note->encrypt) {
            include_once "$fnsDir/encrypt_text.php";
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
