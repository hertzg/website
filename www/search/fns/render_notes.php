<?php

function render_notes ($notes, $total,
    $groupLimit, &$items, $regex, $encodedKeyword) {

    $fnsDir = __DIR__.'/../../fns';

    $num_notes = count($notes);
    if ($total > $groupLimit) array_pop($notes);

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
        $items[] = create_note_link($title, $note->tags_json, $encrypt, $href);

    }

    if ($num_notes < $total) {
        include_once "$fnsDir/Page/imageArrowLink.php";
        $items[] = Page\imageArrowLink("Show All $total Notes",
            "../notes/search/?keyword=$encodedKeyword", 'notes');
    }

}
