<?php

function render_notes ($notes, &$items, $params, $base = '') {

    $fnsDir = __DIR__.'/../../fns';

    if ($notes) {
        include_once "$fnsDir/create_note_link.php";
        foreach ($notes as $note) {

            $id = $note->id;
            $options = ['id' => $id];
            $queryString = htmlspecialchars(
                http_build_query(
                    array_merge(['id' => $id], $params)
                )
            );
            $href = "{$base}view/?$queryString";

            $encrypt = $note->encrypt;

            $text = $note->text;
            if ($encrypt) {
                include_once "$fnsDir/encrypt_text.php";
                $text = encrypt_text($text);
            }
            $title = htmlspecialchars($text);

            $items[] = create_note_link($title,
                $note->tags, $encrypt, $href, $options);

        }
    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = Page\info('No notes');
    }

}
