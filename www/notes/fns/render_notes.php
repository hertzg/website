<?php

function render_notes ($notes, &$items, $params, $base = '') {

    $fnsDir = __DIR__.'/../../fns';

    if ($notes) {

        include_once "$fnsDir/Session/EncryptionKey/get.php";
        $encryption_key = Session\EncryptionKey\get();

        include_once "$fnsDir/create_note_link.php";
        foreach ($notes as $note) {

            $id = $note->id;
            $queryString = htmlspecialchars(
                http_build_query(
                    array_merge(['id' => $id], $params)
                )
            );
            $href = "{$base}view/?$queryString";

            if ($note->password_protect) {
                if ($encryption_key === null) $title = '****';
                else {
                    include_once "$fnsDir/Crypto/decrypt.php";
                    $title = Crypto\decrypt($encryption_key,
                        $note->encrypted_title, $note->encrypted_title_iv);
                }
            } else {
                $title = $note->title;
            }

            $encrypt_in_listings = $note->encrypt_in_listings;
            if ($encrypt_in_listings) {
                include_once "$fnsDir/encrypt_text.php";
                $title = encrypt_text($title);
            }
            $title = htmlspecialchars($title);

            $items[] = create_note_link($title, $note->num_tags,
                $note->tags_json, $encrypt_in_listings,
                $href, ['id' => $id], true);

        }

    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = Page\info('No notes');
    }

}
