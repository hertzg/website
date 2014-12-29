<?php

namespace SearchPage;

function renderNotes ($notes, &$items, $params, $keyword) {

    $fnsDir = __DIR__.'/../../../fns';

    if ($notes) {

        $regex = '/('.preg_quote(htmlspecialchars($keyword), '/').')+/i';

        include_once "$fnsDir/create_note_link.php";
        foreach ($notes as $note) {

            $id = $note->id;
            $options = ['id' => "note_$id"];
            $queryString = htmlspecialchars(
                http_build_query(
                    array_merge(['id' => $id], $params)
                )
            );
            $href = "../view/?$queryString";

            $encrypt = $note->encrypt;

            $text = $note->text;
            if ($encrypt) {
                include_once "$fnsDir/encrypt_text.php";
                $title = htmlspecialchars(encrypt_text($text));
            } else {
                $escapedText = htmlspecialchars($text);
                $title = preg_replace($regex, '<mark>$0</mark>', $escapedText);
            }

            $items[] = create_note_link($title,
                $note->tags, $encrypt, $href, $options);

        }

    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = \Page\info('No notes found');
    }

}
