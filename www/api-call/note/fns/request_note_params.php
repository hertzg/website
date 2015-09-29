<?php

function request_note_params () {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Notes/request.php";
    list($text, $tags, $encrypt_in_listings,
        $password_protect) = Notes\request();

    if ($text === '') {
        include_once "$fnsDir/ErrorJson/badRequest.php";
        ErrorJson\badRequest('"ENTER_TEXT"');
    }

    include_once __DIR__.'/../../fns/require_tags.php';
    list($tags, $tag_names) = require_tags();

    if ($password_protect) {
        include_once "$fnsDir/Session/EncryptionKey/get.php";
        $encryption_key = Session\EncryptionKey\get();
        if ($encryption_key === null) {
            include_once "$fnsDir/ErrorJson/badRequest.php";
            ErrorJson\badRequest('"CANNOT_PASSWORD_PROTECT"');
        }
    } else {
        $encryption_key = null;
    }

    return [$text, $tags, $tag_names,
        $encrypt_in_listings, $password_protect, $encryption_key];

}
