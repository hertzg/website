<?php

function render_notes (array $notes, array &$items, $regex) {
    include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
    foreach ($notes as $note) {
        $title = htmlspecialchars($note->text);
        $title = preg_replace($regex, '<mark>$0</mark>', $title);
        $href = "../notes/view/?id=$note->id_notes";
        $items[] = Page\imageArrowLink($title, $href, 'note');
    }
}
