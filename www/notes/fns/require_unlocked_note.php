<?php

function require_unlocked_note ($mysqli, $base = '') {

    include_once __DIR__.'/require_note.php';
    list($note, $id, $user) = require_note($mysqli, $base);

    if ($note->password_protect) {

        $fnsDir = __DIR__.'/../../fns';

        include_once "$fnsDir/Session/EncryptionKey/get.php";
        $encryption_key = Session\EncryptionKey\get();

        if ($encryption_key === null) {
            include_once "$fnsDir/redirect.php";
            include_once "$fnsDir/ItemList/itemQuery.php";
            redirect('../view/'.ItemList\itemQuery($id));
        }

        include_once "$fnsDir/Crypto/decrypt.php";
        $text = Crypto\decrypt($encryption_key,
            $note->encrypted_text, $note->encrypted_text_iv);

        if ($text === false) {
            include_once "$fnsDir/redirect.php";
            include_once "$fnsDir/ItemList/itemQuery.php";
            redirect('../view/'.ItemList\itemQuery($id));
        }

    } else {
        $text = $note->text;
    }

    return [$note, $id, $user, $text];

}
