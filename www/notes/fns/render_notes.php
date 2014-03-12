<?php

function render_notes (array $notes, array &$items, $emptyMessage, $base = '') {
    if ($notes) {
        include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
        foreach ($notes as $note) {
            $title = htmlspecialchars($note->notetext);
            $description = "{$base}view/?id=$note->idnotes";
            $items[] = Page\imageArrowLink($title, $description, 'note');
        }
    } else {
        include_once __DIR__.'/../../fns/Page/info.php';
        $items[] = Page\info($emptyMessage);
    }
}
