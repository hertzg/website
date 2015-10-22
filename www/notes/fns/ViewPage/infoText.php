<?php

namespace ViewPage;

function infoText ($note) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/format_author.php";
    $author = format_author($note->insert_time, $note->insert_api_key_name);
    $text = '';
    if ($note->encrypt_in_listings) $text .= 'Encrypted in listings.<br />';
    if ($note->password_protect) $text .= 'Password-protected.<br />';
    $text .= "Note created $author.";
    if ($note->revision) {
        $author = format_author($note->update_time, $note->update_api_key_name);
        $text .= "<br />Last modified $author.";
    }

    include_once "$fnsDir/Page/infoText.php";
    return \Page\infoText($text);

}
