<?php

function render_notes ($notes, &$items, $params, $base = '') {

    $fnsPageDir = __DIR__.'/../../fns/Page';

    if ($notes) {

        include_once "$fnsPageDir/imageArrowLink.php";
        foreach ($notes as $note) {

            $queryString = htmlspecialchars(
                http_build_query(
                    array_merge(['id' => $note->id_notes], $params)
                )
            );
            $href = "{$base}view/?$queryString";

            $text = $note->text;
            if ($note->encrypt) {
                include_once __DIR__.'/../../fns/encrypt_text.php';
                $text = encrypt_text($text);
                $icon = 'encrypted-note';
            } else {
                $icon = 'note';
            }

            $title = htmlspecialchars($text);
            $items[] = Page\imageArrowLink($title, $href, $icon);

        }
    } else {
        include_once "$fnsPageDir/info.php";
        $items[] = Page\info('No notes');
    }

}
