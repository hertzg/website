<?php

function require_note_params (&$text, &$tags, &$tag_names,
    &$encrypt_in_listings, &$password_protect, &$encryption_key) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Notes/request.php";
    list($text, $tags, $encrypt_in_listings,
        $password_protect) = Notes\request();

    if ($text === '') {
        include_once "$fnsDir/ApiCall/Error/badRequest.php";
        ApiCall\Error\badRequest('"ENTER_TEXT"');
    }

    include_once "$fnsDir/ApiCall/requireTags.php";
    ApiCall\requireTags($tags, $tag_names);

    if ($password_protect) {
        include_once "$fnsDir/Session/EncryptionKey/get.php";
        $encryption_key = Session\EncryptionKey\get();
        if ($encryption_key === null) {
            include_once "$fnsDir/ApiCall/Error/badRequest.php";
            ApiCall\Error\badRequest('"CANNOT_PASSWORD_PROTECT"');
        }
    } else {
        $encryption_key = null;
    }

}
