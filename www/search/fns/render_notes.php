<?php

function render_notes ($notes, $total,
    $groupLimit, &$items, $regex, $encodedKeyword) {

    $fnsDir = __DIR__.'/../../fns';

    $num_notes = count($notes);
    if ($total > $groupLimit) array_pop($notes);

    include_once "$fnsDir/create_note_link.php";
    foreach ($notes as $note) {

        $encrypt_in_listings = $note->encrypt_in_listings;

        $text = $note->text;
        if ($encrypt_in_listings) {
            include_once "$fnsDir/encrypt_text.php";
            $title = htmlspecialchars(encrypt_text($text));
        } else {
            $escapedText = htmlspecialchars($text);
            $title = preg_replace($regex, '<mark>$0</mark>', $escapedText);
        }

        $items[] = create_note_link($title, $note->num_tags,
            $note->tags_json, $encrypt_in_listings,
            "../notes/view/?id=$note->id&amp;keyword=$encodedKeyword");

    }

    if ($num_notes < $total) {
        include_once "$fnsDir/Page/imageArrowLink.php";
        $items[] = Page\imageArrowLink("Show All $total Notes",
            "../notes/search/?keyword=$encodedKeyword", 'notes');
    }

}
