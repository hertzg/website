<?php

function render_note ($note, $description,
    $href, $options, $encryption_key, &$items) {

    $fnsDir = __DIR__.'/../../fns';

    if ($note->password_protect) {
        if ($encryption_key === null) $title = '****';
        else {
            include_once "$fnsDir/Crypto/decrypt.php";
            $title = Crypto\decrypt($encryption_key,
                hex2bin($note->encrypted_title), $note->encrypted_title_iv);
            if ($title === false) $title = '****';
        }
    } else {
        $title = $note->title;
    }

    if ($note->encrypt_in_listings) {
        include_once "$fnsDir/encrypt_text.php";
        $title = encrypt_text($title);
    }

    if ($note->encrypt_in_listings) $icon = 'encrypted-note';
    else $icon = 'note';

    $title = htmlspecialchars($title);

    $items[] = Page\imageArrowLinkWithDescription(
        $title, $description, $href, $icon, $options);

}
