<?php

function render_notes (array $notes, array &$items, array $params) {

    if ($notes) {
        include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
        foreach ($notes as $note) {

            $queryString = htmlspecialchars(
                http_build_query(
                    array_merge(['id' => $note->id_notes], $params)
                )
            );
            $href = "view/?$queryString";

            $text = $note->text;
            if ($note->encrypt) {
                include_once __DIR__.'/../../fns/encrypt_text.php';
                $text = encrypt_text($text);
            }

            $title = htmlspecialchars($text);
            $items[] = Page\imageArrowLink($title, $href, 'note');

        }
    } else {
        include_once __DIR__.'/../../fns/Page/info.php';
        $items[] = Page\info('No notes');
    }

}
