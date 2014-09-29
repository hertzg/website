<?php

function render_notes ($notes, &$items, $params, $base = '') {

    $fnsDir = __DIR__.'/../../fns';

    if ($notes) {

        include_once "$fnsDir/Page/imageArrowLink.php";
        foreach ($notes as $note) {

            $queryString = htmlspecialchars(
                http_build_query(
                    array_merge(['id' => $note->id_notes], $params)
                )
            );
            $href = "{$base}view/?$queryString";

            $text = $note->text;
            if ($note->encrypt) {
                include_once "$fnsDir/encrypt_text.php";
                $text = encrypt_text($text);
                $icon = 'encrypted-note';
            } else {
                $icon = 'note';
            }

            $title = htmlspecialchars($text);
            $items[] = Page\imageArrowLink($title, $href, $icon);

        }
    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = Page\info('No notes');
    }

}
