<?php

function render_notes (array $notes, array &$items, $emptyMessage,
    array $params, $base = '') {

    if ($notes) {
        include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
        foreach ($notes as $note) {

            $queryString = htmlspecialchars(
                http_build_query(
                    array_merge(['id' => $note->id_notes], $params)
                )
            );
            $href = "{$base}view/?$queryString";

            $title = htmlspecialchars($note->text);
            $items[] = Page\imageArrowLink($title, $href, 'note');

        }
    } else {
        include_once __DIR__.'/../../fns/Page/info.php';
        $items[] = Page\info($emptyMessage);
    }

}
