<?php

namespace SearchPage;

function renderNotes ($notes, &$items, $params, $includes) {

    $fnsDir = __DIR__.'/../../../fns';

    if ($notes) {

        include_once "$fnsDir/keyword_regex.php";
        $regex = keyword_regex($includes);

        include_once "$fnsDir/create_note_link.php";
        foreach ($notes as $note) {

            $id = $note->id;
            $options = ['id' => $id];
            $queryString = htmlspecialchars(
                http_build_query(
                    array_merge(['id' => $id], $params)
                )
            );
            $href = "../view/?$queryString";

            $encrypt_in_listings = $note->encrypt_in_listings;

            $text = $note->text;
            if ($encrypt_in_listings) {
                include_once "$fnsDir/encrypt_text.php";
                $title = htmlspecialchars(encrypt_text($text));
            } else {
                $escapedText = htmlspecialchars($text);
                $title = preg_replace($regex, '<mark>$0</mark>', $escapedText);
            }

            $items[] = create_note_link($title, $note->num_tags,
                $note->tags_json, $encrypt_in_listings, $href, $options);

        }

    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = \Page\info('No notes found');
    }

}
