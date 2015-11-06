<?php

function request_note_params (&$errors, &$focus) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Notes/request.php";
    list($text, $tags, $encrypt_in_listings,
        $password_protect) = Notes\request();

    if ($text === '') {
        $errors[] = 'Enter text.';
        $focus = 'text';
    }

    include_once "$fnsDir/request_tags.php";
    request_tags($tags, $tag_names, $errors, $focus);

    return [$text, $tags, $tag_names, $encrypt_in_listings, $password_protect];

}
