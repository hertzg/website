<?php

function request_note_params (&$errors) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Notes/request.php";
    list($text, $tags, $encrypt_in_listings) = Notes\request();

    if ($text === '') $errors[] = 'Enter text.';

    include_once "$fnsDir/request_tags.php";
    request_tags($tags, $tag_names, $errors);

    return [$text, $tags, $tag_names, $encrypt_in_listings];

}
