<?php

function render_notes ($user, $notes, &$items, $params, $base = '') {

    $fnsDir = __DIR__.'/../../fns';

    if ($notes) {

        include_once "$fnsDir/resolve_theme.php";
        resolve_theme($user, $theme_color, $theme_brightness);

        include_once "$fnsDir/create_note_link.php";
        foreach ($notes as $note) {

            $id = $note->id;
            $queryString = htmlspecialchars(
                http_build_query(
                    array_merge(['id' => $id], $params)
                )
            );
            $href = "{$base}view/?$queryString";

            $encrypt = $note->encrypt;

            $title = $note->title;
            if ($encrypt) {
                include_once "$fnsDir/encrypt_text.php";
                $title = encrypt_text($title);
            }
            $title = htmlspecialchars($title);

            $items[] = create_note_link($theme_brightness,
                $title, $note->num_tags, $note->tags_json,
                $encrypt, $href, ['id' => $id], true);

        }

    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = Page\info('No notes');
    }

}
