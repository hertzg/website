<?php

function render_notes (array $notes, array &$items) {
    if ($notes) {
        foreach ($notes as $note) {
            $title = htmlspecialchars($note->notetext);
            $description = "view/?id=$note->idnotes";
            $items[] = Page::imageArrowLink($title, $description, 'note');
        }
    } else {
        include_once __DIR__.'/../../fns/Page/info.php';
        $items[] = Page\info('No notes.');
    }
}
