<?php

function render_notes (array $notes, array &$items) {
    if ($notes) {
        include_once __DIR__.'/../../../fns/Page/imageArrowLink.php';
        foreach ($notes as $note) {
            $title = htmlspecialchars($note->text);
            $href = "../view/?id=$note->id_notes";
            $items[] = Page\imageArrowLink($title, $href, 'note');
        }
    } else {
        include_once __DIR__.'/../../../fns/Page/info.php';
        $items[] = Page\info('No notes found');
    }
}
