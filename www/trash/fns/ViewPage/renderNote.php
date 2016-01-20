<?php

namespace ViewPage;

function renderNote ($note, &$items, &$infoText) {

    $fnsDir = __DIR__.'/../../../fns';

    if ($note->password_protect) {

        $infoText = "Password-protected.<br />$infoText";

        include_once "$fnsDir/Session/EncryptionKey/get.php";
        $encryption_key = \Session\EncryptionKey\get();

        if ($encryption_key === null) $text = '****';
        else {

            include_once "$fnsDir/Crypto/decrypt.php";
            $text = \Crypto\decrypt($encryption_key,
                hex2bin($note->encrypted_text), $note->encrypted_text_iv);

            if ($text === false) $text = '****';

        }

    } else {
        $text = $note->text;
    }

    include_once "$fnsDir/Page/text.php";
    $items[] = \Page\text(nl2br(htmlspecialchars($text)));

    $tags = $note->tags;
    if ($tags !== '') $items[] = \Page\text('Tags: '.htmlspecialchars($tags));

    if ($note->encrypt_in_listings) {
        $infoText = "Encrypted in listings.<br />.$infoText";
    }

}
