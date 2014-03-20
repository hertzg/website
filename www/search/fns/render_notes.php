<?php

function render_notes (array $notes, array &$items) {
    include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
    foreach ($notes as $note) {
        $title = htmlspecialchars($note->notetext);
        $href = "../notes/view/?id=$note->idnotes";
        $items[] = Page\imageArrowLink($title, $href, 'note');
    }
}
