<?php

namespace SearchPage;

function renderNotes ($notes, &$items, $params, $keyword) {

    $fnsDir = __DIR__.'/../../../fns';

    if ($notes) {

        $regex = '/('.preg_quote(htmlspecialchars($keyword), '/').')+/i';

        include_once "$fnsDir/Page/imageArrowLink.php";
        foreach ($notes as $note) {

            $queryString = htmlspecialchars(
                http_build_query(
                    array_merge(['id' => $note->id_notes], $params)
                )
            );
            $href = "../view/?$queryString";

            $text = $note->text;
            if ($note->encrypt) {
                include_once "$fnsDir/encrypt_text.php";
                $title = htmlspecialchars(encrypt_text($text));
                $icon = 'encrypted-note';
            } else {
                $escapedText = htmlspecialchars($text);
                $title = preg_replace($regex, '<mark>$0</mark>', $escapedText);
                $icon = 'note';
            }

            $items[] = \Page\imageArrowLink($title, $href, $icon);

        }

    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = \Page\info('No notes found');
    }

}
