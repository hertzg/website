<?php

function render_notes (array $notes, array &$items, array $params, $keyword) {

    if ($notes) {

        $regex = '/('.preg_quote(htmlspecialchars($keyword)).')+/i';

        include_once __DIR__.'/../../../fns/Page/imageArrowLink.php';
        foreach ($notes as $note) {

            $queryString = htmlspecialchars(
                http_build_query(
                    array_merge(['id' => $note->id_notes], $params)
                )
            );
            $href = "../view/?$queryString";

            $title = htmlspecialchars($note->text);
            $title = preg_replace($regex, '<mark>$0</mark>', $title);
            $items[] = Page\imageArrowLink($title, $href, 'note');

        }

    } else {
        include_once __DIR__.'/../../../fns/Page/info.php';
        $items[] = Page\info('No notes found');
    }

}
